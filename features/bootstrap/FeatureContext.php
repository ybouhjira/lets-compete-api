<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Sanpi\Behatch\Context\JsonContext;
use Sanpi\Behatch\HttpCall\HttpCallResultPool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpKernel\Kernel;
use Sanpi\Behatch\HttpCall\Request;
use Sanpi\Behatch\HttpCall\Request as BehatchRequest;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $manager;

    /**
     * @var SchemaTool
     */
    private $schemaTool;

    /**
     * @var array
     */
    private $classes;

    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var array Guzzle options
     */
    private $options;

    /**
     * @var BehatchRequest
     */
    private $request;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var HttpCallResultPool
     */
    private $httpCallResultPool;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param ManagerRegistry $doctrine
     * @param Kernel $kernel
     * @internal param BehatchRequest $request
     */
    public function __construct(ManagerRegistry $doctrine,
                                Kernel $kernel,
                                BehatchRequest $request,
                                EntityManager $entityManager)
    {
        $this->client = new GuzzleHttp\Client();
        $this->options = [['verify' => false]];
        $this->request = $request;

        $this->kernel = $kernel;
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
        $this->em = $entityManager;
        $this->schemaTool = new SchemaTool($this->manager);
        $this->classes = $this->manager->getMetadataFactory()->getAllMetadata();
    }

    /**
     * @BeforeScenario
     */
    public function beginTransaction()
    {
        $this->em->getConnection()->beginTransaction();
    }

    /**
     * @BeforeScenario @createSchema
     */
    public function createDatabase()
    {
        $this->schemaTool->createSchema($this->classes);
        $this->executeFixtures();
    }

    private function executeFixtures()
    {
        $kernel = $this->kernel;
        $app = new Application($kernel);
        $app->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'hautelook:fixtures:load', '-n'
        ));

        $output = new NullOutput();
        $app->run($input, $output);
    }

    /**
     * @AfterScenario @dropSchema
     */
    public function dropDatabase()
    {
        $this->schemaTool->dropSchema($this->classes);
    }

    /**
     * @Then The file :file exists in web folder :folder
     */
    public function theFileExistsInWebFolder($file, $folder)
    {
        return new PendingException();
    }

    /**
     * @When I set the content-type to multipart\/form-data
     */
    public function iSetTheContentTypeToMultipartFormData()
    {
        $this->options['multipart'] = [
            [
                'name'     => 'photo',
                'contents' => fopen(__DIR__ . '/photo.jpg', 'r')
            ],
        ];
    }

    /**
     * @Then I do a GET request on on his :subresources
     */
    public function iDoAGetRequestOnOnHis($subresources)
    {
        $matches = [];
        preg_match(
            "/\\d+/",
            $this->request->getContent(),
            $matches
        );
        $id = $matches[0];

        return $this->request->send(
            'GET',
            "/organisateurs/$id/$subresources"
        );
    }

}
