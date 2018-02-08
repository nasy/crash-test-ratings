<?php

namespace AppBundle\Validator;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 13:22
 */


class GetVehiclesValidator
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
        $year,
        $manufacturer,
        $model,
        $withRating
    ) {
        if (is_numeric($year)) {
            $this->year = (int) $year;
        }
        if (is_string($manufacturer)) {
            $this->manufacturer = $manufacturer;
        }
        if (is_string($model)) {
            $this->model = $model;
        }
        $this->withRating = ($withRating === "true" || $withRating === true);
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
     * @return bool
     */
    public function withRating()
    {
        return $this->withRating;
    }
}
