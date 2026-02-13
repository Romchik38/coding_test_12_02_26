<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Tests\Unit\Helpers\CarrierCalculator;
use PHPUnit\Framework\TestCase;
use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\VO\Name;
use App\Domain\Carrier\VO\Price;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\VO\Weight;

class CarrierTest extends TestCase
{
    public function testCalculateShippingPriceByWeight(): void
    {
        $name = new Name('Carrier1');
        $slug = new Slug('carrier1');
        $carrier = new Carrier(
            $name,
            $slug,
            new CarrierCalculator(new Price(1.0))
        );

        $weight = new Weight(10);
        $calculatedPrice = $carrier->calculateShippingPriceByWeight($weight);
        $this->assertSame(1.0, $calculatedPrice->value);
    }
}
