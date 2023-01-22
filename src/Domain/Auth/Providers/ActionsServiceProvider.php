<?php

namespace Domain\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\Auth\Actions\GithubCallbackAction;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\Contracts\SocialiteCallbackContract;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * @info instead boot method app()->bindings()
     */
    public array $bindings = [
        RegisterNewUserContract::class => RegisterNewUserAction::class,
        SocialiteCallbackContract::class => GithubCallbackAction::class,
    ];

}