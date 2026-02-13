<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\CarrierService\Helpers;

use App\Domain\Carrier\ShippingCostCalculatorInterface;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Weight;

final class CarrierCalculator implements ShippingCostCalculatorInterface
{
    public function __construct(
        public readonly Price $price
    ) {
    }

    public function calculateShippingCosts(Weight $weight): Price
    {
        return $this->price;
    }
}
