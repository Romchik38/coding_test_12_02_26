<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Persist\Carrier;

use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\VO\Weight;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\Persist\Carrier\CarrierRepository;

class CarrierRepositoryTest extends TestCase
{
    public array $data = [
        [
            'Transcompany',
            'transcompany',
            'App\Tests\Unit\Infrastructure\Persist\Carrier\Helpers\CarrierCalculator'
        ],
        [
            'PackGroup',
            'packgroup',
            'App\Tests\Unit\Infrastructure\Persist\Carrier\Helpers\CarrierCalculator'
        ]
    ];

    public function testFindCarrierBySlug(): void
    {
        require __DIR__ . '/Helpers/CarrierCalculator.php';
        $repository = new CarrierRepository($this->data);
        $slug = new Slug('packgroup');
        $carrier = $repository->findCarrierBySlug($slug);
        $this->assertSame('PackGroup', $carrier->name->value);
        $this->assertSame('packgroup', $carrier->slug->value);
        $price = $carrier->calculateShippingPriceByWeight(new Weight(10.5));
        $this->assertSame(10.5, $price->value);
    }
}
