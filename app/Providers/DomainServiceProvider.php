<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Catalog\Providers\CatalogServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            AuthServiceProvider::class,
            CatalogServiceProvider::class
        );
    }
}