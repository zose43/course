<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use Tests\TestCase;
use Domain\Auth\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseAuthController extends TestCase
{
    use RefreshDatabase;

    protected const EMAIL = 'test@mail.ru';
    protected const TABLE = 'users';
    
    protected array $request;

    protected function createUser(string $password): User
    {
        return UserFactory::new()->create([
            'password' => bcrypt($password),
            'email' => 'test@mail.ru',
        ]);
    }
}