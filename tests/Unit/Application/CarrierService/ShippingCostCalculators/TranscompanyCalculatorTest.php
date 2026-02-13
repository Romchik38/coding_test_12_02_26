<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\CarrierService\ShippingCostCalculators;

use PHPUnit\Framework\TestCase;
use App\Application\CarrierService\ShippingCostCalculators\TranscompanyCalculator;
use App\Domain\Carrier\VO\Weight;

class TranscompanyCalculatorTest extends TestCase
{
    public function testCalculateShippingCosts(): void
    {
        $calculator = new TranscompanyCalculator();

        $weight1 = new Weight(1.0);
        $price1 = $calculator->calculateShippingCosts($weight1);
        $this->assertSame(20.0, $price1->value);

        $weight2 = new Weight(11.0);
        $price2 = $calculator->calculateShippingCosts($weight2);
        $this->assertSame(100.0, $price2->value);
    }
}
