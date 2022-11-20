<?php

namespace Tests\Feature\Domain\Auth\Actions;

use Tests\TestCase;
use Domain\Auth\Actions\GithubCallbackAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\Traits\GithubCallbackAction as GithubMock;

/**
 * @coversDefaultClass GithubCallbackAction
 */
class GithubCallbackActionTest extends TestCase
{
    use RefreshDatabase;
    use GithubMock;

    /**
     * @test
     */
    public function is_user_email_equals(): void
    {
        $this->mockSocialiteCallback();
        $action = app(GithubCallbackAction::class);
        $user = $action($this->driver);

        $this->assertEquals(self::EMAIL, $user->email);
    }
}