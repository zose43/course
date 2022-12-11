<?php

namespace Domain\Catalog\Providers;

use App\Filters\PriceFilter;
use App\Filters\BrandFilter;
use Illuminate\Support\ServiceProvider;
use Domain\Catalog\Filters\FilterManager;

class CatalogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(FilterManager::class)
            ->register([
                new PriceFilter(),
                new BrandFilter(),
            ]);
    }

    public function register(): void
    {
        $this->app->singleton(FilterManager::class);

        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}