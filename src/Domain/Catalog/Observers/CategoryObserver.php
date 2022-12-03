<?php

namespace Domain\Catalog\Observers;

use Domain\Catalog\Models\Category;
use Support\Traits\Models\FlushCache;

class CategoryObserver
{
    use FlushCache;

    public function created(Category $category): void
    {
        $this->flush('category');
    }

    public function updated(Category $category): void
    {
        $this->flush('category');
    }

    public function deleted(Category $category): void
    {
        $this->flush('category');
    }
}