<?php

namespace Domain\Catalog\Sorts;

use Support\Traits\DTOs\Makeable;
use Illuminate\Support\Collection;

class Sort
{
    use Makeable;

    protected array $items = [];

    public function all(): Collection
    {
        return collect($this->items);
    }

    public function add(Sort $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function addIf(bool|callable $statement, Sort $item): self
    {
        if (is_callable($statement) ? $statement() : $statement) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function title(): string
    {
        return 'Сортировать по';
    }

    public function name(): string
    {
        return 'sort';
    }

    public function isSelected(): bool
    {
        return request($this->name()) === $this->key;
    }
}