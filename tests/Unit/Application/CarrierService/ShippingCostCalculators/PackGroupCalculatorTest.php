<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\CarrierService\ShippingCostCalculators;

use PHPUnit\Framework\TestCase;
use App\Application\CarrierService\ShippingCostCalculators\PackGroupCalculator;
use App\Domain\Carrier\VO\Weight;

class PackGroupCalculatorTest extends TestCase
{
    public function testCalculateShippingCosts(): void
    {
        $calculator = new PackGroupCalculator();
        $weight1 = new Weight(1.0);
        $price1 = $calculator->calculateShippingCosts($weight1);
        $this->assertSame(1.0, $price1->value);

        $weight2 = new Weight(11.0);
        $price2 = $calculator->calculateShippingCosts($weight2);
        $this->assertSame(11.0, $price2->value);
    }
}
