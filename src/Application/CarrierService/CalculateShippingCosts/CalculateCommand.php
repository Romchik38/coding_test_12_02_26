<?php

declare(strict_types=1);

namespace App\Application\CarrierService\CalculateShippingCosts;

final class CalculateCommand
{
    public readonly string $carrierSlug;
    public readonly string $weight;
}