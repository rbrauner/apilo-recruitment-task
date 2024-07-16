<?php

declare(strict_types=1);

namespace App\Inpost\Domain\Model;

final class City
{
    public function __construct(
        private string $name,
        private AddressDetails $addressDetails
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressDetails(): AddressDetails
    {
        return $this->addressDetails;
    }

    public function setAddressDetails(AddressDetails $addressDetails): self
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }
}
