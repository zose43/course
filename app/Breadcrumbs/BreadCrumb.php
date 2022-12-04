<?php

namespace App\Breadcrumbs;

use Countable;
use Traversable;
use IteratorAggregate;
use Support\Traits\DTOs\Makeable;
use Illuminate\Support\Collection;

class BreadCrumb implements IteratorAggregate, Countable
{
    use Makeable;

    protected array $items = [];

    public function add(BreadCrumb $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function addIf(bool|callable $condition, BreadCrumb $item): self
    {
        if (is_callable($condition) ? $condition() : $condition) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function all(): Collection
    {
        return collect($this->items);
    }

    public function remove(BreadCrumb $item): array
    {
        return $this->all()
            ->filter(fn($v) => $v !== $item)
            ->toArray();
    }

    public function getIterator(): Traversable
    {
        return $this->all();
    }

    public function count(): int
    {
        return $this->all()->count();
    }
}