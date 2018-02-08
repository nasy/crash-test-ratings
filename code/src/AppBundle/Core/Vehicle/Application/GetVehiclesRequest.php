<?php

namespace AppBundle\Core\Vehicle\Application;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

class GetVehiclesRequest
{
    /** @var int $year */
    private $year;
    /** @var string $manufacturer */
    private $manufacturer;
    /** @var string $model */
    private $model;
    /** @var bool $withRating */
    private $withRating;

    public function __construct(
        int $year = null,
        string $manufacturer = null,
        string $model = null,
        bool $withRating
    ) {
        $this->year = $year;
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->withRating = $withRating;
    }

    /**
     * @return int
     */
    public function year()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function manufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return boolean
     */
    public function withRating()
    {
        return $this->withRating;
    }
}
