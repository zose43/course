<?php

namespace Domain\Order\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Order\Actions\NewOrderAction;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        NewOrderAction::class,
    ];
}
