<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Support\Faker\FakerImageProvider;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, static function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));

            return $faker;
        });
    }

    public function boot(): void {}
}