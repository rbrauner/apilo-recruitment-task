<?php

declare(strict_types=1);

namespace App\Inpost\Domain\Model;

final class AddressDetails
{
    public function __construct(
        private ?string $city = null,
        private ?string $province = null,
        private ?string $postCode = null,
        private ?string $street = null,
        private ?int $buildingNumber = null,
        private ?int $flatNumber = null,
    ) {
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getBuildingNumber(): ?int
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(?int $buildingNumber): self
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    public function getFlatNumber(): ?int
    {
        return $this->flatNumber;
    }

    public function setFlatNumber(?int $flatNumber): self
    {
        $this->flatNumber = $flatNumber;

        return $this;
    }
}
