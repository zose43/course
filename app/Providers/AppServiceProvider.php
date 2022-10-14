<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\PDO\Connection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /** предотвращает лишнюю загрузку  */
        Model::preventLazyLoading(!app()->isProduction());
        /** check fillable */
        Model::preventSilentlyDiscardingAttributes((!app()->isProduction()));

        /** query execute time */
        DB::whenQueryingForLongerThan(500, function (Connection $connection) {            // todo logger
        });
    }
}
