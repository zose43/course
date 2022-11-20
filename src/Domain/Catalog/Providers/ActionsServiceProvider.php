<?php

namespace Domain\Catalog\Providers;

use Carbon\Laravel\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * @info instead boot method app()->bindings()
     */
    public array $bindings = [
    ];

}