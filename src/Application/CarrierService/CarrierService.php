<?php

declare(strict_types=1);

namespace App\Application\CarrierService;

use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;
use App\Application\CarrierService\CalculateShippingCosts\CalculateException;
use App\Application\CarrierService\CalculateShippingCosts\CalculateView;
use App\Domain\Carrier\VO\Slug;
use App\Domain\Carrier\VO\Weight;
use InvalidArgumentException;

final class CarrierService
{
    public function __construct(
        private readonly CarrierRepositoryInterface $repository
    ) {
    }

    /**
     * @throws InvalidArgumentException
     * @throws CalculateException
     */
    public function calculateShippingCosts(CalculateCommand $command): CalculateView
    {
        $slug = new Slug($command->carrierSlug);
        $weight = Weight::fromString($command->weight);

        try {
            $carrier = $this->repository->findCarrierBySlug($slug);
        } catch (NoSuchCarrierException $e) {
            throw new CalculateException($e->getMessage());
        }

        $price = $carrier->calculateShippingPriceByWeight($weight);

        return new CalculateView(
            $slug,
            $weight,
            $price
        );
    }
}
