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
        // TODO reddis/memcache, add tag, add observers (create/delete/update)
        return Cache::rememberForever('category_home_page', static function () {
            return Category::query()
                ->select(['id', 'title', 'slug'])
                ->homePage()
                ->get();
        });
    }
}