<?php

declare(strict_types=1);

namespace App\Application\CarrierService;

use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;

final class CarrierService
{
    public function __construct(
        private readonly CarrierRepositoryInterface $repository
    ) {
    }
    
    public function calculateShippingCosts(CalculateCommand $command)
}