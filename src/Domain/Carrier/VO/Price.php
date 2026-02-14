<?php

declare(strict_types=1);

namespace App\Domain\Carrier\VO;

use InvalidArgumentException;

final class Price
{
    public function __construct(
        public readonly float $value
    ) {
        if ($value < 0) {
            throw new InvalidArgumentException('param carrier price is invalid');
        }
    }
}
