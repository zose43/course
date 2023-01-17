<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Cart\Providers\CartServiceProvider;
use Domain\Order\Providers\OrderServiceProvider;
use Domain\Catalog\Providers\CatalogServiceProvider;
use Domain\Product\Providers\ProductServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        array_map(fn(string $v) => $this->app->register($v), $this->provides());
    }

    public function provides(): array
    {
        return [
            AuthServiceProvider::class,
            CatalogServiceProvider::class,
            ProductServiceProvider::class,
            CartServiceProvider::class,
            OrderServiceProvider::class,
        ];
    }
}