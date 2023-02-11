<?php

namespace App\Providers;

use Leeto\MoonShine\MoonShine;
use Leeto\MoonShine\Menu\MenuItem;
use Leeto\MoonShine\Menu\MenuGroup;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\OptionResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\PropertyResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->registerResources([
            MenuGroup::make('Торговые элементы', [
                MenuItem::make('Товар', new ProductResource()),
                MenuItem::make('Бренд', new BrandResource()),
                MenuItem::make('Категория', new CategoryResource()),
                MenuItem::make('Торговая опция продукта', new OptionResource()),
                MenuItem::make('Свойство продукта', new PropertyResource()),
            ]),

            MenuItem::make('Documentation', 'https://laravel.com')
                ->badge(fn() => 'Check'),
        ]);
    }
}
