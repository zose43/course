<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Auth\Events\Registered;
use Domain\Auth\Contracts\RegisterNewUserContract;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTO $dto): void
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
        ]);

        event(new Registered($user));
        auth()->login($user);
    }
}