<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\VO;

use App\Domain\Carrier\VO\Price;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testNegativePrice(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Price(-1);
    }
}
