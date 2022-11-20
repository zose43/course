<?php

namespace Domain\Catalog\ViewModels;

use Cache;
use Domain\Catalog\Models\Brand;
use Support\Traits\DTOs\Makeable;
use Illuminate\Database\Eloquent\Collection;

class BrandViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
        // TODO reddis/memcache, add tag, add observers (create/delete/update)
        return Cache::rememberForever('brand_home_page', static function () {
            return Brand::query()
                ->select(['id', 'title', 'slug', 'thumbnail'])
                ->homePage()
                ->get();
        });
    }
}