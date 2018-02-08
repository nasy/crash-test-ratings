<?php

namespace Tests\AppBundle\Core\Vehicle\Application;

use AppBundle\Core\Vehicle\Application\GetVehiclesRequest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetVehiclesRequestTest extends WebTestCase
{
    public function testClass()
    {
        $year = 2015;
        $manufacturer = 'Audi';
        $model ='A4';
        $withRating = true;
        $vehiclesRequest = new GetVehiclesRequest($year, $manufacturer, $model, $withRating);
        $this->assertInstanceOf(GetVehiclesRequest::class, $vehiclesRequest);

        $this->assertSame($year, $vehiclesRequest->year());
        $this->assertSame($manufacturer, $vehiclesRequest->manufacturer());
        $this->assertSame($model, $vehiclesRequest->model());
        $this->assertSame($withRating, $vehiclesRequest->withRating());
    }
}
