<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Support\SessionRegenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SignInFormRequest;

class SignInController extends Controller
{
    public function page(): View
    {
        return view('auth.login');
    }

    public function handle(SignInFormRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Неверно введены данные',
            ])->onlyInput('email');
        }

        SessionRegenerator::run();

        return redirect()->intended(route('home'));
    }

    public function logOut(): RedirectResponse
    {
        SessionRegenerator::run(
            static fn() => auth()->logout());

        return redirect()->route('home');
    }
}