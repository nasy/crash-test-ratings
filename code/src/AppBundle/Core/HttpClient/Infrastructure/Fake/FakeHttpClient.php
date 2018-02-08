<?php

namespace AppBundle\Core\HttpClient\Infrastructure\Fake;

use AppBundle\Core\HttpClient\DomainModel\HttpClientInterface;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

class FakeHttpClient implements HttpClientInterface
{
    public function sendRequest(string $url)
    {
        return [];
    }
}
