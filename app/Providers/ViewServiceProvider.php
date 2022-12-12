<?php

namespace App\Providers;

use Vite;
use View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\SortViewComposer;
use App\Http\ViewComposers\NavigationViewComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Vite::macro('image', fn($asset) => $this->asset("resources/images/$asset"));
        View::composer('*', NavigationViewComposer::class);
        View::composer('catalog.index', SortViewComposer::class);
    }
}