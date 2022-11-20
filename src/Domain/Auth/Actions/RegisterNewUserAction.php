<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Contracts\RegisterNewUserContract;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
        ]);
    }
}