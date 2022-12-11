<?php

namespace Domain\Catalog\Sorts;

use Support\Traits\DTOs\Makeable;
use Illuminate\Support\Collection;
use Domain\Catalog\Models\Category;

class Sort
{
    use Makeable;

    protected array $items = [];
    protected Category $category;

    public function all(): Collection
    {
        return collect($this->items);
    }

    public function category(): Category
    {
        return $this->category;
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

    public function route(): string
    {
        return catalogUrl($this->category(), [
            $this->name() => $this->key(),
        ]);
    }
}