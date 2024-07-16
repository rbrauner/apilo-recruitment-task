<?php

declare(strict_types=1);

namespace App\Inpost\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetParcelsForCityQuery
{
    public function __construct(
        #[Assert\NotBlank]
        private string $city,
    ) {
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
