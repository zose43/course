<?php

namespace Domain\Auth\Providers;

use Carbon\Laravel\ServiceProvider;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * @info instead boot method app()->bindings()
     */
    public array $bindings = [
        RegisterNewUserContract::class => RegisterNewUserAction::class,
    ];

}