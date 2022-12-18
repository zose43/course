<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Routing\Registrar;
use App\Http\Controllers\CatalogController;

class CatalogRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware([
            'web',
            'catalog.product.view',
        ])->group(static function () {
            Route::get('/catalog/{category:slug?}', CatalogController::class)->name('catalog');
        });
    }
}