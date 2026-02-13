<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Persist\Carrier\Helpers;

use App\Domain\Carrier\ShippingCostCalculatorInterface;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Weight;

final class CarrierCalculator implements ShippingCostCalculatorInterface
{
    public function calculateShippingCosts(Weight $weight): Price
    {
        return new Price($weight->value);
    }
}
