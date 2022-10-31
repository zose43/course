<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home');

Route::controller(AuthController::class)->group(static function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'signIn')->name('sign-in');

    Route::get('/sign-up', 'signUp')->name('sign-up');
    Route::post('/sign-up', 'store')->name('store');

    Route::get('/forgot-password', 'forgot')->middleware('guest')->name('password.email');
    Route::post('/forgot-password', 'forgotPassword')->middleware('guest')->name('password.request');

    Route::get('/reset/{token}/{email}', 'reset')->middleware('guest')->name('reset');
    Route::post('/reset', 'resetPassword')->middleware('guest')->name('password.reset');

    Route::delete('/logout', 'logOut')->name('log-out');

    Route::get('/auth/socialite/github', 'github')->middleware('guest')->name('socialite.github');
    Route::get('/auth/socialite/github/callback', 'githubCallback')->middleware('guest')->name('socialite.github.callback');
});
