<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use DomainException;
use Mockery\MockInterface;
use Database\Factories\UserFactory;
use Illuminate\Testing\TestResponse;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Auth\SocialAuthController;

/**
 * @coversDefaultClass
 */
class SocialAuthControllerTest extends BaseAuthController
{
    use RefreshDatabase;

    private string|int $githubId;

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

    private function callbackRequest(): TestResponse
    {
        return $this->get(action([SocialAuthController::class, 'callback'],
            ['driver' => 'github']));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->githubId = str()->random(10);
    }

    /**
     * @test
     * @covers SocialAuthController::redirect
     */
    public function is_github_redirect_success(): void
    {
        $response = $this->get(action([SocialAuthController::class, 'redirect'],
            ['driver' => 'github']));

        $response->assertRedirectContains('github.com');
    }

    /**
     * @test
     * @covers SocialAuthController::callback
     */
    public function is_driver_not_support_exception(): void
    {
        $driver = ['driver' => 'vk'];
        $this->expectException(DomainException::class);

        $this->withoutExceptionHandling()
            ->get((action([SocialAuthController::class, 'callback'], $driver)));

        $this->withoutExceptionHandling()
            ->get((action([SocialAuthController::class, 'redirect'], $driver)));
    }

    /**
     * @test
     * @covers SocialAuthController::callback
     */
    public function is_github_callback_created_user_success(): void
    {
        $this->mockSocialiteCallback();

        $this->assertDatabaseMissing(self::TABLE, ['github_id' => $this->githubId]);

        $this->callbackRequest()
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();

        $this->assertDatabaseHas(self::TABLE, ['github_id' => $this->githubId]);
    }

    /**
     * @test
     * @covers SocialAuthController::callback
     */
    public function is_authenticated_by_existing_github_id(): void
    {
        $this->mockSocialiteCallback();
        UserFactory::new()->create([
            'github_id' => $this->githubId,
        ]);

        $this->assertDatabaseHas(self::TABLE, ['github_id' => $this->githubId]);

        $this->callbackRequest()
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }
}