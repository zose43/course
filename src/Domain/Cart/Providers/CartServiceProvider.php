<?php

namespace Domain\Cart\Providers;

use Domain\Cart\CartManager;
use Illuminate\Support\ServiceProvider;
use Domain\Cart\Contracts\CartIdentityStorageContract;
use Domain\Cart\StorageIdentities\SessionStorageIdentity;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );

        $this->app->bind(CartIdentityStorageContract::class, SessionStorageIdentity::class);

        $this->app->singleton(CartManager::class);
    }

    public function boot(): void {}
}
