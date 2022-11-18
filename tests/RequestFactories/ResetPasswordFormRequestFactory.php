<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ResetPasswordFormRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        $password = $this->faker->password(8);

        return [
            'token' => str()->random(10),
            'email' => $this->faker->email(),
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }
}
