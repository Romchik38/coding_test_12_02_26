<?php

declare(strict_types=1);

namespace App\Domain\Carrier;

use App\Domain\Carrier\VO\Name;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\VO\Weight;

final class Carrier
{
    public function __construct(
        public Name $name,
        public Slug $slug,
        public readonly ShippingCostCalculatorInterface $calculator
    ) {
    }

    public function calculateShippingPriceByWeight(Weight $weight): Price
    {
        return $this->calculator->calculateShippingCosts($weight);
    }
}
