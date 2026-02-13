<?php

declare(strict_types=1);

namespace App\Application\CarrierService;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\VO\Slug;

interface CarrierRepositoryInterface
{
    public function findCarrierBySlug(Slug $slug): Carrier;
}