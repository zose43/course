<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Domain\Product\Models\Product;
use Illuminate\Support\Collection;
use Domain\Catalog\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Domain\Catalog\ViewModels\CategoryViewModel;

class CatalogViewModel extends ViewModel
{
    public function __construct(public Category $category) {}

    public function products(): LengthAwarePaginator
    {
        return Product::query()
            ->withCategory($this->category)
            ->search()
            ->filtered()
            ->sorted()
            ->paginate(6);
    }

    public function categories(): Collection
    {
        return CategoryViewModel::make()
            ->catalog();
    }
}
