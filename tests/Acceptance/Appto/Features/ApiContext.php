<?php

declare(strict_types=1);

namespace Test\Acceptance\Appto\Features;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Test\Acceptance\Appto\Mink\MinkHelper;
use Test\Acceptance\Appto\Mink\MinkSessionRequestHelper;
use RuntimeException;
use Behat\Behat\Hook\Scope\BeforeFeatureScope;

class ApiContext extends RawMinkContext
{
    private $sessionHelper;
    private $minkSession;
    private $request;
    private static $entityManager;

    public function __construct(Session $minkSession, EntityManagerInterface $entityManager)
    {
        $this->minkSession   = $minkSession;
        $this->sessionHelper = new MinkHelper($this->minkSession);
        $this->request       = new MinkSessionRequestHelper($this->sessionHelper);
        self::$entityManager = $entityManager;
    }

    /** @BeforeFeature */
    public static function setupFeature(BeforeFeatureScope $scope)
    {
        self::$entityManager->clear();
        $meta = self::$entityManager->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool(self::$entityManager);
        $tool->dropSchema($meta);
        $tool->createSchema($meta);
    }

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo($method, $url): void
    {
        $this->request->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body): void
    {
        $this->request->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual   = $this->sanitizeOutput($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (!empty($actual)) {
            throw new RuntimeException(
                sprintf("The outputs is not empty, Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then print last api response
     */
    public function printApiResponse(): void
    {
        print_r($this->sessionHelper->getResponse());
    }

    /**
     * @Then print response headers
     */
    public function printResponseHeaders(): void
    {
        print_r($this->sessionHelper->getResponseHeaders());
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode): void
    {
        if ($this->minkSession->getStatusCode() !== (int) $expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->minkSession->getStatusCode(),
                    $expectedResponseCode
                )
            );
        }
    }

    private function sanitizeOutput(string $output)
    {
        return json_encode(json_decode(trim($output), true));
    }

    /**
     * @Then the response should not be empty
     */
    public function theResponseShouldNotBeEmpty()
    {
        $xml = $this->getSession()->getDriver()->getContent();

        if ($xml === '[]') {
            throw new RuntimeException(
                sprintf("The output is empty, xml:\n%s", $xml)
            );
        }
    }
}
