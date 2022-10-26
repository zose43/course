<?php

use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
})->name('home');

Route::get('/login', static function () {
    return view('auth.index');
})->name('login');
