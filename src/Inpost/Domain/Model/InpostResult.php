<?php

declare(strict_types=1);

namespace App\Inpost\Domain\Model;

final class InpostResult
{
    /**
     * @param City[] $items
     */
    public function __construct(
        private int $count = 0,
        private int $page = 0,
        private int $totalPages = 0,
        private array $items = []
    ) {
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * @return list<City>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param list<City> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
