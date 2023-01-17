<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Contracts\Routing\Registrar;

final class OrderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(static function () {
            Route::get('/order', [OrderController::class, 'index'])->name('order.index');
            Route::post('/order', [OrderController::class, 'handle'])->name('order.handle');
        });
    }
}
