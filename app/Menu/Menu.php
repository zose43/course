<?php

namespace App\Menu;

use Countable;
use Traversable;
use IteratorAggregate;
use Support\Traits\DTOs\Makeable;
use App\Collections\MenuCollection;

class Menu implements IteratorAggregate, Countable
{
    use Makeable;

    protected array $items = [];

    public function add(Menu $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function all(): MenuCollection
    {
        return MenuCollection::make($this->items);
    }

    public function addIf(bool|callable $condition, Menu $item): self
    {
        if (is_callable($condition) ? $condition() : $condition) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function remove(Menu $item): self
    {
        $this->items = $this->all()
            ->filter(fn($v) => $v !== $item)
            ->toArray();

        return $this;
    }

    public function removeByLink(string $link): self
    {
        $this->items = $this->all()
            ->filter(fn(MenuItem $v) => $v->getLink() !== $link)
            ->toArray();

        return $this;
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