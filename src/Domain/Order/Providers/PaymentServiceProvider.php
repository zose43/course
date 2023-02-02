<?php

namespace Domain\Order\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // call payment system
    }
}
