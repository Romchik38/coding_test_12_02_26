<?php

declare(strict_types=1);

namespace App\Tests\Unit\VO;

use App\Domain\Carrier\VO\Weight;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WeightTest extends TestCase
{
    public function testZeroWeight(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Weight(0);
    }

    public function testNegativeWeight(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Weight(-1);
    }
}
