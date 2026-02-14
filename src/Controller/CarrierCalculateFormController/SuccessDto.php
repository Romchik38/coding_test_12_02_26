<?php

declare(strict_types=1);

namespace App\Controller\CarrierCalculateFormController;

use App\Application\CarrierService\CalculateShippingCosts\CalculateView;

final class SuccessDto extends Dto
{
    public function __construct(
        public readonly CalculateView $data,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            $this::STATUS_FIELD => $this::SUCCESS_FIELD,
            $this::RESULT_FIELD => $this->data
        ];
    }
}
