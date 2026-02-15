<?php

declare(strict_types=1);

namespace App\Domain\Carrier\VO;

use InvalidArgumentException;

final class Slug
{
    /** @throws InvalidArgumentException */
    public function __construct(
        public readonly string $value
    ) {
        if ($value === '') {
            throw new InvalidArgumentException('param carrier slug is invalid');
        }
    }
}
