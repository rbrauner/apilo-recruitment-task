<?php

declare(strict_types=1);

namespace App\Inpost\Presentation\Dto;

/**
 * Query params DTO for GetParcelsController.
 */
final readonly class GetParcelsParamsDto
{
    public function __construct(
        private ?string $city = null,
        private ?string $postCode = null,
    ) {
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }
}
