<?php

declare(strict_types=1);

namespace App\Domain\Carrier\VO;

use InvalidArgumentException;

/** 
 * @throws InvalidArgumentException
 */
final class Slug
{
    public function __construct(
        public readonly string $value
    ) {
        if ($value === '') {
            throw new InvalidArgumentException('param value is invalid');
        }
    }
}