<?php

declare(strict_types=1);

namespace App\Application\CarrierService\CalculateShippingCosts;

final class CalculateCommand
{
    public const slugField = 'carrier';
    public const weightField = 'weightKg';

    public function __construct(
        public readonly string $carrierSlug,
        public readonly string $weight
    ) {
    }

    public static function fromHash(array $hash): self
    {
        $slug = $hash[self::slugField] ?? '';
        $weight = $hash[self::weightField] ?? '';
        return new self($slug, $weight);
    }
}
