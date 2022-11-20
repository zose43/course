<?php

namespace Tests\Fixtures\Traits;

use Mockery\MockInterface;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;

trait GithubCallbackAction
{
    private string|int $githubId;
    private string $driver;

    private function mockSocialiteCallback(): MockInterface
    {
        /** Multiply method mock in 1 class */
        $user = $this->mock(User::class, function (MockInterface $m) {
            $m->shouldReceive('getName')
                ->once()
                ->andReturn(str()->random(10));

            $m->shouldReceive('getId')
                ->once()
                ->andReturn($this->githubId);

            $m->shouldReceive('getEmail')
                ->once()
                ->andReturn(self::EMAIL);
        });

        /** mock chain methods */
        Socialite::shouldReceive('driver->user')
            ->once()
            ->andReturn($user);

        return $user;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->githubId = str()->random(10);
        $this->driver = 'github';
    }
}