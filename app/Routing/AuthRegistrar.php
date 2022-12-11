<?php

namespace App\Routing;

use App\contracts\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Routing\Registrar;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

class AuthRegistrar implements RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware([
            'web',
            'throttle:auth',
            'guest',
        ])->group(function () {
            Route::controller(SignInController::class)->group(static function () {
                Route::get('/login', 'page')
                    ->name('login');
                Route::post('/login', 'handle')
                    ->name('login.handle');
                Route::delete('/logout', 'logOut')
                    ->name('log-out')
                    ->withoutMiddleware('guest');
            });

            Route::controller(SignUpController::class)->group(function () {
                Route::get('/sign-up', 'page')
                    ->name('sign-up');
                Route::post('/sign-up', 'handle')
                    ->name('sign-up.handler');
            });

            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('/forgot-password', 'page')
                    ->name('forgot');
                Route::post('/forgot-password', 'handle')
                    ->name('forgot.handler');
            });

            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('/reset/{token}/{email}', 'page')
                    ->name('reset');
                Route::post('/reset', 'handle')
                    ->name('reset.handler');
            });

            Route::controller(SocialAuthController::class)->group(function () {
                Route::get('/auth/socialite/{driver}', 'redirect')
                    ->name('socialite.github');
                Route::get('/auth/socialite/{driver}/callback', 'callback')
                    ->name('socialite.callback');
            });
        });
    }
}