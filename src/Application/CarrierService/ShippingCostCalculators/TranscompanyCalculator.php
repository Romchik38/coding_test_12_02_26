<?php

declare(strict_types=1);

namespace App\Application\CarrierService\ShippingCostCalculators;

use App\Domain\Carrier\ShippingCostCalculatorInterface;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Weight;

final class TranscompanyCalculator implements ShippingCostCalculatorInterface
{
    public function calculateShippingCosts(Weight $weight): Price
    {
        $price = 0;
        if ($weight->value <= 10) {
            $price = 20;
        } else {
            $price = 100;
        }

        return new Price($price);
    }
}
