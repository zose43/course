<?php

namespace App\Providers;

use Event;
use App\Models\Seo;
use App\Observers\SeoObserver;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailNewUserListener;
use Domain\Catalog\Observers\BrandObserver;
use App\Events\AfterSessionRegeneratedEvent;
use Domain\Catalog\Observers\CategoryObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Brand::class => BrandObserver::class,
        Category::class => CategoryObserver::class,
        Seo::class => SeoObserver::class
    ];

    protected $listen = [
        Registered::class => [
//            SendEmailVerificationNotification::class,
            SendEmailNewUserListener::class,
        ],
    ];

    public function boot(): void
    {
        Event::listen(AfterSessionRegeneratedEvent::class, static function (AfterSessionRegeneratedEvent $event) {
            cart()->updateStorageId($event->old, $event->current);
        });
    }
}
