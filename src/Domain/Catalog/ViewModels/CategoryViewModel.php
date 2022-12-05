<?php

namespace Domain\Catalog\ViewModels;

use Support\Traits\DTOs\Makeable;
use Domain\Catalog\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class CategoryViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
        return Cache::tags(['main_page', 'category'])
            ->rememberForever('category_home_page', function () {
                return Category::query()
                    ->select(['id', 'title', 'slug'])
                    ->homePage()
                    ->get();
            });
    }

    public function catalog(): Collection|array
    {
        return Cache::tags(['main_page', 'category'])
            ->rememberForever('category_catalog', function () {
                return Category::query()
                    ->select(['title', 'slug'])
                    ->has('products')
                    ->get();
            });
    }
}