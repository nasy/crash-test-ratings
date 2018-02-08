<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VehicleController extends Controller
{
    /**
     * @Route("/vehicles", name="vehicles")
     */
    public function indexAction(Request $request)
    {
        return $this->json([]);
    }
}
