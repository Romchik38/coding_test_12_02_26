<?php

declare(strict_types=1);

namespace App\Domain\Carrier\VO;

use InvalidArgumentException;

final class Weight
{
    /**
     * Weight in kg
     * @throws InvalidArgumentException
     */
    public function __construct(
        public float $value
    ) {
        if ($value <= 0) {
            throw new InvalidArgumentException('param carrier weight is invalid');
        }
    }

    public static function fromString(string $value): self
    {
        return new self(floatval($value));
    }
}
