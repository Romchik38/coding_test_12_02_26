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
            throw new InvalidArgumentException('param value is invalid');
        }
    }
}