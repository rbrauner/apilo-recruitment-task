<?php

declare(strict_types=1);

namespace App\Inpost\Application\Query;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetParcelsQuery
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 64)]
    private string $city;

    public function __construct(
        string $city,
        #[Assert\Type('string')]
        #[Assert\Regex(pattern: '/^\d{2}-\d{3}$/')]
        private ?string $postCode = null,
    ) {
        $city = mb_strtolower($city);
        $city = explode(' ', $city);
        array_walk($city, fn (&$value): string => $value = ucfirst($value));
        $city = implode(' ', $city);

        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }
}
