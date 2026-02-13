<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarrierCalculateFormController extends AbstractController
{
    #[Route('/carrier/calculate/form', name: 'app_carrier_calculate_form')]
    public function index(): Response
    {
        return $this->render('carrier_calculate_form/index.html.twig', [
            'controller_name' => 'CarrierCalculateFormController',
        ]);
    }
}
