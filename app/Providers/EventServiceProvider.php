<?php

namespace App\Providers;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailNewUserListener;
use Domain\Catalog\Observers\BrandObserver;
use Domain\Catalog\Observers\CategoryObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Brand::class => BrandObserver::class,
        Category::class => CategoryObserver::class,
    ];

    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
            SendEmailNewUserListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
