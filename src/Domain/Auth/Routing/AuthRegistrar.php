<?php

namespace Domain\Auth\Routing;

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
        Route::middleware('web')->group(function () {
            Route::controller(SignInController::class)->group(static function () {
                Route::get('/login', 'page')->name('login');
                Route::post('/login', 'handle')->name('login.handle')->middleware('throttle:auth');

                Route::delete('/logout', 'logOut')->name('log-out');
            });

            Route::controller(SignUpController::class)->group(function () {
                Route::get('/sign-up', 'page')->name('sign-up');
                Route::post('/sign-up', 'handle')->name('sign-up.handler')->middleware('throttle:auth');
            });

            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('/forgot-password', 'page')->middleware('guest')->name('forgot');
                Route::post('/forgot-password', 'handle')->middleware('guest')->name('forgot.handler');
            });

            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('/reset/{token}/{email}', 'page')->middleware('guest')->name('reset');
                Route::post('/reset', 'handle')->middleware('guest')->name('reset.handler');
            });

            Route::controller(SocialAuthController::class)->group(function () {
                Route::get('/auth/socialite/{driver}', 'redirect')->middleware('guest')->name('socialite.github');
                Route::get('/auth/socialite/{driver}/callback', 'callback')->middleware('guest')->name('socialite.callback');
            });
        });
    }
}