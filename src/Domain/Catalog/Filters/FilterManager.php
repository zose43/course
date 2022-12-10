<?php

namespace Domain\Catalog\Filters;

class FilterManager
{
    protected array $items;

    public function register(array $items): void
    {
        $this->items = $items;
    }

    public function items(): array
    {
        return $this->items;
    }
}