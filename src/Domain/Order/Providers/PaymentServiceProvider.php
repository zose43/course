<?php

namespace Domain\Order\Providers;

use Domain\Order\DTOs\PaymentDataDTO;
use Illuminate\Support\ServiceProvider;
use Domain\Order\Payment\PaymentSystem;
use Domain\Order\Payment\PaymentEventsManager;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        PaymentSystem::provider();

        PaymentEventsManager::setOnCreating(static function (PaymentDataDTO $data) {
            return $data;
        });
    }
}
