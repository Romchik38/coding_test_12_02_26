<?php

declare(strict_types=1);

namespace App\Domain\Carrier;

use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Weight;

interface ShippingCostCalculatorInterface
{
    public function calculateShippingCosts(Weight $weight): Price;
}