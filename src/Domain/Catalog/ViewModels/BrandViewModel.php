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
        return Cache::tags(['main_page', 'brand'])
            ->rememberForever('brand_home_page', function () {
                return Brand::query()
                    ->select(['id', 'title', 'slug', 'thumbnail'])
                    ->homePage()
                    ->get();
            });
    }
}