<?php

declare(strict_types=1);

namespace App\Infrastructure\Persist\Carrier;

use App\Application\CarrierService\CarrierRepositoryInterface;
use App\Application\CarrierService\NoSuchCarrierException;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\VO\Name;

final class CarrierRepository implements CarrierRepositoryInterface
{
    /** @param array<string, Carrier> $carriers */
    private array $carriers = [];

    /**
     * @param array<int,array<int<string>>
     */
    public function __construct(
        array $carriers
    ) {
        foreach ($carriers as $carrier) {
            $name = $carrier[0] ?? null;
            $slug = $carrier[1] ?? null;
            $classname = $carrier[2] ?? null;
            if (
                $name === null ||
                $slug === null ||
                $classname === null
            ) {
                continue;
            }
            $obj = new Carrier(
                new Name($name),
                new Slug($slug),
                new $classname()
            );
            $this->carriers[$slug] = $obj;
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
