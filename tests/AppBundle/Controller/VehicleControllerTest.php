<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VehicleControllerTest extends WebTestCase
{
    public function testGetVehiclesWithRating()
    {
        $client = static::createClient();
        $client->request('GET', '/vehicles/2015/Audi/A3?withRating=true');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);

        $this->validateVehiclesResponseWithRating($decoded);
    }

    public function testGetVehiclesWithOutRating()
    {
        $client = static::createClient();
        $client->request('GET', '/vehicles/2015/Audi/A3?withRating=false');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);
        $this->validateVehiclesResponseWithoutRating($decoded);
    }

    public function testGetVehiclesNoResults()
    {
        $client = static::createClient();
        $client->request('GET', '/vehicles/0/Chicken/A3?withRating=false');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);

        $this->assertInternalType('integer', $decoded->Count);
        $this->assertTrue($decoded->Count == 0);

        $this->assertInternalType('array', $decoded->Results);
        $this->assertTrue(sizeof($decoded->Results) == 0);
    }

    public function testPostVehiclesWithRating()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/vehicles?withRating=true',
            [],
            [],
            [],
            json_encode(
                [
                    "year" => 2015,
                    "manufacturer" => "Audi",
                    "model" => "A3"
                ]
            )
        );
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);
        $this->validateVehiclesResponseWithRating($decoded);
    }

    public function testPostVehiclesWithoutRating()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/vehicles?withRating=false',
            [],
            [],
            [],
            json_encode(
                [
                    "year" => 2015,
                    "manufacturer" => "Audi",
                    "model" => "A3"
                ]
            )
        );
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);
        $this->validateVehiclesResponseWithoutRating($decoded);
    }

    public function testPostVehiclesNoResults()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/vehicles?withRating=true',
            [],
            [],
            [],
            json_encode(
                [
                    "year" => 0,
                    "manufacturer" => "Chicken",
                    "model" => "A3"
                ]
            )
        );
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $decoded = json_decode($content);

        $this->assertInternalType('integer', $decoded->Count);
        $this->assertTrue($decoded->Count == 0);

        $this->assertInternalType('array', $decoded->Results);
        $this->assertTrue(sizeof($decoded->Results) == 0);
    }

    private function validateVehiclesResponseWithRating($decoded)
    {
        $this->assertInternalType('integer', $decoded->Count);
        $this->assertTrue($decoded->Count>0);

        $this->assertInternalType('array', $decoded->Results);
        $this->assertTrue(sizeof($decoded->Results)>0);

        foreach ($decoded->Results as $vehicle) {
            $this->assertInternalType('integer', $vehicle->VehicleId);
            $this->assertInternalType('string', $vehicle->Description);
            $this->assertInternalType('string', $vehicle->CrashRating);
        }
    }

    private function validateVehiclesResponseWithoutRating($decoded)
    {
        foreach ($decoded->Results as $vehicle) {
            $this->assertFalse(property_exists($vehicle, 'CrashRating'));
        }
    }
}
