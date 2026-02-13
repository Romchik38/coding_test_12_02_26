<?php

declare(strict_types=1);

namespace App\Application\CarrierService\CalculateShippingCosts;

use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\VO\Weight;

final class CalculateView
{
    public function __construct(
        public readonly Slug $carrierSlug,
        public readonly Weight $weight,
        public readonly Price $price
    ) {
    }

    public function getSlug(): string
    {
        return $this->carrierSlug->value;
    }

    public function getWeight(): float
    {
        return $this->weight->value;
    }
}