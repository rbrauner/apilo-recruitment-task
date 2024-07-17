<?php

declare(strict_types=1);

namespace App\Inpost\Domain\Model;

/**
 * Model of Inpost result.
 */
final class InpostResult
{
    /**
     * @param City[] $items
     */
    public function __construct(
        private ?int $count = null,
        private ?int $page = null,
        private ?int $totalPages = null,
        private ?array $items = null
    ) {
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * @return City[]
     */
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * @param City[] $items
     */
    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
