<?php

declare(strict_types=1);

namespace App\Application\CarrierService;

use App\Application\CarrierService\CalculateShippingCosts\CalculateCommand;
use App\Application\CarrierService\CalculateShippingCosts\CalculateException;
use App\Application\CarrierService\CalculateShippingCosts\CalculateView;
use App\Application\CarrierService\List\ListDto;
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
        try {
            $slug = new Slug($command->carrierSlug);
            $weight = Weight::fromString($command->weight);
            $carrier = $this->repository->findCarrierBySlug($slug);
        } catch (NoSuchCarrierException | InvalidArgumentException  $e) {
            throw new CalculateException($e->getMessage());
        }

        $price = $carrier->calculateShippingPriceByWeight($weight);

        return new CalculateView(
            $slug,
            $weight,
            $price
        );
    }

    /**
     * @return array<int, ListDto>
     */
    public function list(): array
    {
        $carriers = $this->repository->list();
        $dtos = [];
        foreach ($carriers as $carrier) {
            $dtos[] = new ListDto(
                $carrier->name,
                $carrier->slug
            );
        }
        return $dtos;
    }
}
