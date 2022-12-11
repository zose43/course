<?php

namespace Domain\Catalog\Sorts;

use Domain\Catalog\Models\Category;

class SortDefault extends Sort
{
    public function __construct(Category $category, protected string $key = '', protected string $label = '')
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