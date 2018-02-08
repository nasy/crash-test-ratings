<?php

namespace AppBundle\Core\HttpClient\DomainModel;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

interface HttpClientInterface
{
    /**
     * @param string $url
     * @return mixed
     */
    public function sendRequest(string $url);
}
