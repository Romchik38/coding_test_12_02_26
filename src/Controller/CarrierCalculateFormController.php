<?php

namespace App\Controller;

use App\Application\CarrierService\CarrierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;
use App\Application\CarrierService\CalculateShippingCosts\CalculateException;
use App\Controller\CarrierCalculateFormController\ErrorDto;
use App\Controller\CarrierCalculateFormController\SuccessDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/api/shipping/calculate', methods: ['POST'], name: 'api.shipping.calculate')]
    public function calculate(Request $request): JsonResponse
    {
        $params = $request->request->all();
        $command = CalculateCommand::fromHash($params);
        try {
            $viewDto = $this->carrierService->calculateShippingCosts($command);
            $successDto = new SuccessDto($viewDto);
            return new JsonResponse($successDto);
        } catch (CalculateException $e) {
            $errorDto = new ErrorDto($e->getMessage());
            return new JsonResponse($errorDto, 400);
        }
    }
}
