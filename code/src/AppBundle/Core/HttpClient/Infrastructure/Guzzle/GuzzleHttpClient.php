<?php

namespace AppBundle\Core\HttpClient\Infrastructure\Guzzle;

use AppBundle\Core\HttpClient\DomainModel\HttpClientInterface;
use GuzzleHttp\Client;

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
        try {
            $client = new Client([
                'Content-type' => ' application/json',
                'Accept' => ' application/json'
            ]);
            $response = $client->request('GET', $url);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $exception) {
            return [];
        }
    }
}
