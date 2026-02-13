<?php

namespace App\Controller;

use App\Application\CarrierService\CarrierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;

final class CarrierCalculateFormController extends AbstractController
{
    public function __construct(
        private readonly CarrierService $carrierService
    ) {
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $carriers = $this->carrierService->list();

        return $this->render('carrier_calculate_form/index.html.twig', [
            'controller_name' => 'CarrierCalculateFormController',
            'carriers' => $carriers,
            'carrier_slug_field' => CalculateCommand::slugField,
            'carrier_weight_field' => CalculateCommand::weightField,
        ]);
    }
}
