<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Domain\Auth\Actions\ResetPasswordAction;
use App\Http\Requests\ResetPasswordFormRequest;

class ResetPasswordController extends Controller
{
    public function page(string $token, string $email): View
    {
        return view('auth.reset-password', compact('token', 'email'));
    }

    public function handle(ResetPasswordFormRequest $request, ResetPasswordAction $action): RedirectResponse
    {
        $status = $action($request->only('email', 'password', 'password_confirmation', 'token'));
        if ($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));

            return redirect()->route('login');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}