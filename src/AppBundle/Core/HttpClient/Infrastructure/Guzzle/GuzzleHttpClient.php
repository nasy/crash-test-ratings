<?php

namespace AppBundle\Core\HttpClient\Infrastructure\Guzzle;

use AppBundle\Core\HttpClient\DomainModel\HttpClientInterface;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

class GuzzleHttpClient implements HttpClientInterface
{
    public function sendRequest(string $url)
    {
        $exec = exec('curl -X GET -H "Content-type: application/json" -H "Accept: application/json" '.$url);
        $result = json_decode($exec);
        return $result;
    }
}
