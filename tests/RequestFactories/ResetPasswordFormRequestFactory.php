<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ResetPasswordFormRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'token' => str()->random(10),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(8),
        ];
    }
}
