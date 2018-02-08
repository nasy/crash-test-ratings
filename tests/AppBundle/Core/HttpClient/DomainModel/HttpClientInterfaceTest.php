<?php

namespace Tests\AppBundle\Core\HttpClient\DomainModel;

use AppBundle\Core\HttpClient\DomainModel\HttpClientInterface;
use AppBundle\Core\HttpClient\Infrastructure\Fake\FakeHttpClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HttpClientInterfaceTest extends WebTestCase
{
    public function testClass()
    {
        $fakeHttpClient = new FakeHttpClient();
        $this->assertInstanceOf(HttpClientInterface::class, $fakeHttpClient);

        $fakeHttpClient->sendRequest('');
        $this->assertTrue(true);
    }
}
