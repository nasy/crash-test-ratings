<?php

namespace Tests\AppBundle\Core\Vehicle\Application;

use AppBundle\Core\HttpClient\Infrastructure\Fake\FakeHttpClient;
use AppBundle\Core\Vehicle\Application\GetVehiclesRequest;
use AppBundle\Core\Vehicle\Application\GetVehiclesResponse;
use AppBundle\Core\Vehicle\Application\GetVehiclesService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetVehiclesServiceTest extends WebTestCase
{
    public function testClassWithRating()
    {
        $year = 2015;
        $manufacturer = 'Audi';
        $model ='A4';

        $vehiclesService = new GetVehiclesService(
            new FakeHttpClient(),
            '',
            'json'
        );
        $this->assertInstanceOf(GetVehiclesService::class, $vehiclesService);
        $response = $vehiclesService->execute(
            new GetVehiclesRequest($year, $manufacturer, $model, true)
        );
        $this->assertInstanceOf(GetVehiclesResponse::class, $response);
    }

    public function testClassWithNoRating()
    {
        $year = 2015;
        $manufacturer = 'Audi';
        $model ='A4';

        $vehiclesService = new GetVehiclesService(
            new FakeHttpClient(),
            '',
            'json'
        );
        $this->assertInstanceOf(GetVehiclesService::class, $vehiclesService);
        $response = $vehiclesService->execute(
            new GetVehiclesRequest($year, $manufacturer, $model, false)
        );
        $this->assertInstanceOf(GetVehiclesResponse::class, $response);
    }
}
