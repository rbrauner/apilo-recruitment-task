<?php

declare(strict_types=1);

namespace App\Inpost\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetParcelsQuery
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(min: 1)]
        private string $city,
    ) {
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
