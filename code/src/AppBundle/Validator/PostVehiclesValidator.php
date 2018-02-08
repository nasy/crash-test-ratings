<?php

namespace AppBundle\Validator;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 13:22
 */


class PostVehiclesValidator
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
        $content,
        $withRating
    ) {
        $jsonResponse = json_decode($content);
        if ($jsonResponse instanceof \stdClass) {
            if (property_exists($jsonResponse, 'year') && is_numeric($jsonResponse->year)) {
                $this->year = (int) $jsonResponse->year;
            }
            if (property_exists($jsonResponse, 'manufacturer') && is_string($jsonResponse->manufacturer)) {
                $this->manufacturer = $jsonResponse->manufacturer;
            }
            if (property_exists($jsonResponse, 'model') && is_string($jsonResponse->model)) {
                $this->model = $jsonResponse->model;
            }
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
