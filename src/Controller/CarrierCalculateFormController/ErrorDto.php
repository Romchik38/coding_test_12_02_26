<?php

declare(strict_types=1);

namespace App\Controller\CarrierCalculateFormController;

use InvalidArgumentException;

final class ErrorDto extends Dto
{
    public function __construct(
        public readonly string $errorMessage
    ) {
        if ($errorMessage === '') {
            throw new InvalidArgumentException('param error message is invalid');
        }
    }

    public function jsonSerialize(): mixed
    {
        return [
            $this::STATUS_FIELD => $this::ERROR_FIELD,
            $this::RESULT_FIELD => $this->errorMessage
        ];
    }
}
