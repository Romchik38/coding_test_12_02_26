<?php

declare(strict_types=1);

namespace App\Controller\CarrierCalculateFormController;

use InvalidArgumentException;
use JsonSerializable;

final class ErrorDto implements JsonSerializable
{
    public const ERROR_FILED = 'error';

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
            $this::ERROR_FILED => $this->errorMessage
        ];
    }
}
