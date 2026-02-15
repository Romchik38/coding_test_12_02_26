<?php

declare(strict_types=1);

namespace App\Tests\Controller\Helpers;

use App\Domain\Carrier\ShippingCostCalculatorInterface;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Weight;
use RoundingMode;

final class CarrierCalculator implements ShippingCostCalculatorInterface
{
    public function calculateShippingCosts(Weight $weight): Price
    {
        $price = round($weight->value, 0, RoundingMode:: AwayFromZero);
        return new Price($price);
    }
}
