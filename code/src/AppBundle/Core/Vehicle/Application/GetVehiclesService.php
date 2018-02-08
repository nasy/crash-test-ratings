<?php

namespace AppBundle\Core\Vehicle\Application;

use AppBundle\Core\HttpClient\DomainModel\HttpClientInterface;

/**
 * Created by PhpStorm.
 * User: Ignasi
 * Date: 08/02/2018
 * Time: 12:12
 */

class GetVehiclesService
{
    /** @var HttpClientInterface */
    private $httpClient;
    /** @var string */
    private $vehiclesApiEndpoint;
    /** @var string */
    private $vehiclesApiResponseFormat;

    public function __construct(
        HttpClientInterface $httpClient,
        string $vehiclesApiEndpoint,
        string $vehiclesApiResponseFormat
    ) {
        $this->httpClient = $httpClient;
        $this->vehiclesApiEndpoint = $vehiclesApiEndpoint;
        $this->vehiclesApiResponseFormat = $vehiclesApiResponseFormat;
    }

    /**
     * @param GetVehiclesRequest $getVehiclesRequest
     * @return GetVehiclesResponse
     * @throws \Exception
     */
    public function execute(
        GetVehiclesRequest $getVehiclesRequest
    ) : GetVehiclesResponse {
        try {
            $apiEndpoint = $this->vehiclesApiEndpoint;
            if (!is_null($getVehiclesRequest->year())) {
                $apiEndpoint.='/modelyear/'.$getVehiclesRequest->year();
            }
            if (!is_null($getVehiclesRequest->manufacturer())) {
                $apiEndpoint.='/make/'.$getVehiclesRequest->manufacturer();
            }
            if (!is_null($getVehiclesRequest->model())) {
                $apiEndpoint.='/model/'.$getVehiclesRequest->model();
            }
            $apiEndpoint.='?format='.$this->vehiclesApiResponseFormat;
            $vehiclesResponse = $this->httpClient->sendRequest($apiEndpoint);
            $vehicles = [];
            foreach ($vehiclesResponse->Results as $row) {
                $vehicle = [
                    'VehicleId' => $row->VehicleId,
                    'Description' => $row->VehicleDescription
                ];
                if ($getVehiclesRequest->withRating()) {
                    $vehicleApiEndpoint = $this->vehiclesApiEndpoint.'/VehicleId/';
                    $vehicleApiEndpoint.= $row->VehicleId.'?format='.$this->vehiclesApiResponseFormat;
                    $crashRatingResponse = $this->httpClient->sendRequest($vehicleApiEndpoint);
                    $crashRating = "Not Rated";
                    if (isset($crashRatingResponse->Results[0])) {
                        $crashRating = $crashRatingResponse->Results[0]->OverallRating;
                    }
                    $vehicle['CrashRating'] = $crashRating;
                }
                $vehicles[] = $vehicle;
            }
        } catch (\Exception $exception) {
            return new GetVehiclesResponse(0, []);
        }
        return new GetVehiclesResponse($vehiclesResponse->Count, $vehicles);
    }
}
