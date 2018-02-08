<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Core\Vehicle\Application\GetVehiclesRequest;
use AppBundle\Core\Vehicle\Application\GetVehiclesService;
use AppBundle\Validator\GetVehiclesValidator;
use AppBundle\Validator\PostVehiclesValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VehicleController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route(
     *     "/vehicles",
     *     name="post_vehicles"
     * )
     */
    public function postVehiclesAction(Request $request)
    {
        $validator = new PostVehiclesValidator(
            $request->getContent(),
            $request->query->get('withRating')
        );
        /** @var GetVehiclesService $vehiclesService */
        $vehiclesService = $this->get(GetVehiclesService::class);
        $vehiclesResponse = $vehiclesService->execute(
            new GetVehiclesRequest(
                $validator->year(),
                $validator->manufacturer(),
                $validator->model(),
                $validator->withRating()
            )
        );
        return $this->json($vehiclesResponse->data());
    }

    /**
     * @param $year
     * @param $manufacturer
     * @param $model
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route(
     *     "/vehicles/{year}/{manufacturer}/{model}",
     *     name="get_vehicles",
     *     defaults={"year"=null, "manufacturer"=null, "model"=null}
     * )
     */
    public function getVehiclesAction($year, $manufacturer, $model, Request $request)
    {
        $validator = new GetVehiclesValidator(
            $year,
            $manufacturer,
            $model,
            $request->query->get('withRating')
        );
        /** @var GetVehiclesService $vehiclesService */
        $vehiclesService = $this->get(GetVehiclesService::class);
        $vehiclesResponse = $vehiclesService->execute(
            new GetVehiclesRequest(
                $validator->year(),
                $validator->manufacturer(),
                $validator->model(),
                $validator->withRating()
            )
        );
        return $this->json($vehiclesResponse->data());
    }
}
