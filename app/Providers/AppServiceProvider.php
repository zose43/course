<?php

namespace App\Providers;

use DB;
use Faker\Factory;
use App\Http\Kernel;
use Faker\Generator;
use Carbon\CarbonInterval;
use App\Faker\FakerImageProvider;
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
        $this->app->singleton(Generator::class, static function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /**
         * Model::preventLazyLoading(!app()->isProduction()) --> prevents overloading
         * Model::preventSilentlyDiscardingAttributes((!app()->isProduction())) --> check fillable
         * Model::preventAccessingMissingAttributes((!app()->isProduction())) --> check selected properties
         */
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {
            /** query execution time */
            DB::listen(static function ($query) {
                /** use time in ms */
                if ($query->time > 150) {
                    logger()?->channel('telegram')->debug(__METHOD__ . ', sql: ' . $query->sql, $query->bindings);
                }
            });

            /** request cycle */
            app(Kernel::class)->whenRequestLifecycleIsLongerThan(CarbonInterval::seconds(3), static function () {
                logger()?->channel('telegram')->debug(__METHOD__ . ', url: ' . request()?->url());
            });
        }
    }
}
