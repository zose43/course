<?php

namespace Domain\Auth\Actions;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordAction
{
    public function __invoke(array $credentials): string
    {
        return Password::reset(
            $credentials,
            static function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(str()->random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );
    }
}