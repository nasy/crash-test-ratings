<?php

namespace AppBundle\Core\Vehicle\Application;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

class GetVehiclesResponse
{
    /** @var int */
    private $count;
    /** @var array */
    private $results;

    /**
     * @param int $count
     * @param array $results
     */
    public function __construct(
        int $count,
        array $results
    ) {
        $this->count = $count;
        $this->results = $results;
    }

    /**
     * @return array
     */
    public function data()
    {

        return [
            'Count' => $this->count,
            'Results' => $this->results
        ];
    }
}
