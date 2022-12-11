<?php

namespace Domain\Catalog\Sorts;

class SortAlphabet extends Sort
{
    public function __construct(protected string $key, protected string $label) {}

    public function key(): string
    {
        return $this->key;
    }

    public function label(): string
    {
        return $this->label;
    }
}