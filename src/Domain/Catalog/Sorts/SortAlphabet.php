<?php

namespace Domain\Catalog\Sorts;

use Domain\Catalog\Models\Category;

class SortAlphabet extends Sort
{
    public function __construct(protected string $key, protected string $label, Category $category)
    {
        $this->category = $category;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function label(): string
    {
        return $this->label;
    }
}