<?php

namespace Tests\AppBundle\Core\Vehicle\Application;

use AppBundle\Core\Vehicle\Application\GetVehiclesResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetVehiclesResponseTest extends WebTestCase
{
    public function testClass()
    {
        $count = 1;
        $vehicleId = 2;
        $description = 'test';
        $results = [
            [
                'VehicleId' => $vehicleId,
                'Description' => $description
            ]
        ];
        $vehiclesResponse = new GetVehiclesResponse($count, $results);
        $this->assertInstanceOf(GetVehiclesResponse::class, $vehiclesResponse);
        $data = $vehiclesResponse->data();
        $this->assertSame($count, $data['Count']);
        $this->assertSame($vehicleId, $data['Results'][0]['VehicleId']);
        $this->assertSame($description, $data['Results'][0]['Description']);
    }
}
