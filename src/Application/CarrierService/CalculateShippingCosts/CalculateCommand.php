<?php

declare(strict_types=1);

namespace App\Application\CarrierService\CalculateShippingCosts;

use InvalidArgumentException;

final class CalculateCommand
{
    public const slugField = 'carrier';
    public const weightField = 'weightKg';

    public function __construct(
        public readonly string $carrierSlug,
        public readonly string $weight
    ) {
    }

    /** 
     * @throws InvalidArgumentException
     */
    public static function fromHash(array $hash): self
    {
        $slug = $hash[self::slugField] ?? '';
        $weight = $hash[self::weightField] ?? '';
        if (gettype($slug) !== 'string') {
            throw new InvalidArgumentException('param carrier slug is invalid');
        }
        if (gettype($weight) !== 'string') {
            throw new InvalidArgumentException('param weight is invalid');
        }
        return new self($slug, $weight);
    }
}
