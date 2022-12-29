<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SocialAuthController;
use Database\Factories\UserFactory;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\Fixtures\Traits\GithubCallbackAction;

/**
 * @coversDefaultClass
 */
class SocialAuthControllerTest extends BaseAuthController
{
    use RefreshDatabase;
    use GithubCallbackAction;

    private function callbackRequest(): TestResponse
    {
        return $this->get(action([SocialAuthController::class, 'callback'],
            ['driver' => $this->driver]));
    }

    /**
     * @test
     * @covers SocialAuthController::redirect
     */
    public function is_github_redirect_success(): void
    {
        $response = $this->get(action([SocialAuthController::class, 'redirect'],
            ['driver' => $this->driver]));

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