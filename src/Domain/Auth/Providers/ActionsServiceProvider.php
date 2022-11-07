<?php

namespace Domain\Auth\Providers;

use Carbon\Laravel\ServiceProvider;
use Domain\Auth\Actions\SignInNewUserAction;
use Domain\Auth\Actions\GithubCallbackAction;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\SignInNewUserContract;
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