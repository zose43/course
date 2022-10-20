<?php

namespace App\Providers;

use DB;
use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

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
        /** prevents overloading  */
        Model::preventLazyLoading(!app()->isProduction());
        /** check fillable */
        Model::preventSilentlyDiscardingAttributes((!app()->isProduction()));

        /** query execute time */
        DB::whenQueryingForLongerThan(500, static function (Connection $connection) {
            logger()?->channel('telegram')->debug(__METHOD__ . ', sql: ' . $connection->query()->toSql());
        });

        /** request cycle */
        app(Kernel::class)->whenRequestLifecycleIsLongerThan(CarbonInterval::seconds(3), static function () {
            logger()?->channel('telegram')->debug(__METHOD__ . ', url: ' . request()?->url());
        });
    }
}
