<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Domain\Auth\Contracts\RegisterNewUserContract;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(string $name, string $email, string $password): void
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        event(new Registered($user));
        auth()->login($user);
    }
}