<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BaseAuthController extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    protected function createUser(string $password): User
    {
        return UserFactory::new()->create([
            'password' => bcrypt($password),
            'email' => self::EMAIL,
        ]);
    }
}