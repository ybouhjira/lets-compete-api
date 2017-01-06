<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\SchemaTool;
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
                                Kernel $kernel)
    {
        $this->client = new GuzzleHttp\Client();
        $this->options = [['verify' => false]];

        $this->kernel = $kernel;
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
        $this->schemaTool = new SchemaTool($this->manager);
        $this->classes = $this->manager->getMetadataFactory()->getAllMetadata();
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

}
