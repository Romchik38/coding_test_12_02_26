<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\CarrierService\Helpers;

use App\Application\CarrierService\CarrierRepositoryInterface;
use App\Application\CarrierService\NoSuchCarrierException;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\Carrier;
use InvalidArgumentException;

final class CarrierRepository implements CarrierRepositoryInterface
{
    /** @param array<string, Carrier> $carriers */
    private array $carriers = [];

    public function __construct(
        array $carriers
    ) {
        foreach ($carriers as $carrier) {
            if (! $carrier instanceof Carrier) {
                throw new InvalidArgumentException('param carrier is invalid');
            }
            $key = $carrier->slug->value;
            $this->carriers[$key] = $carrier;
        }
    }

    public function findCarrierBySlug(Slug $slug): Carrier
    {
        $key = $slug->value;
        $carrier = $this->carriers[$key] ?? null;
        if ($carrier === null) {
            throw new NoSuchCarrierException(sprintf(
                'Carrier with slig %s not exist',
                $key
            ));
        }
        return $carrier;
    }
}
