<?php

namespace Domain\Cart\Providers;

use Domain\Cart\CartManager;
use Illuminate\Support\ServiceProvider;
use Domain\Cart\StorageIdentities\SessionStorageIdentity;

class CartServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(CartManager::class, function () {
            return new CartManager(new SessionStorageIdentity());
        });
    }

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
