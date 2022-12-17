<?php

namespace Domain\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        // 'Domain\Product\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
//        $this->registerPolicies();

        ResetPassword::createUrlUsing(static function ($user, string $token) {
            return config('app.url') . "/reset/$token/$user->email";
        });
    }

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}