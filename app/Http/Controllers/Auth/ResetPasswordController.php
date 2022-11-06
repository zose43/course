<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordFormRequest;

class ResetPasswordController extends Controller
{
    public function page(string $token, string $email): View
    {
        return view('auth.reset-password', compact('token', 'email'));
    }

    public function handle(ResetPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(str()->random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            flash()->info(__($status));

            return redirect()->route('login');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}