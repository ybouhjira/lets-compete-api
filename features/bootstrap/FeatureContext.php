<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\SchemaTool;
use Sanpi\Behatch\HttpCall\Request;
use Sanpi\Behatch\HttpCall\Request as BehatchRequest;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext, KernelAwareContext
{

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
     * @var array Guzzle options
     */
    private $options;

    /**
     * @var BehatchRequest
     */
    private $request;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param BehatchRequest $request
     * @internal param ManagerRegistry $doctrine
     * @internal param Kernel $kernel
     * @internal param BehatchRequest $request
     */
    public function __construct(BehatchRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @BeforeScenario
     */
    public function beginTransaction()
    {
        $this->conn = $this->kernel->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getConnection();

        $this->conn->beginTransaction();
        $this->conn->setAutoCommit(false);
    }

    /**
     * @AfterScenario
     */
    public function rollback()
    {
        $this->conn->rollBack();
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

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
