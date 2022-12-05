<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\ResetPasswordController;

/**
 * @coversDefaultClass ResetPasswordController
 */
class ResetControllerTest extends BaseAuthController
{
    private array $getParams;

    protected function setUp(): void
    {
        parent::setUp();

        $this->getParams = ['token' => 'dFndWbgSUu', 'email' => self::EMAIL];
        $this->request = ResetPasswordFormRequest::factory()->create();
    }

    /**
     * @test
     */
    public function is_forgot_page_success(): void
    {
        $this->get(route('reset', $this->getParams))
            ->assertOk();
    }

    /**
     * @test
     */
    public function is_forgot_page_view(): void
    {
        $this->get(route('reset', $this->getParams))
            ->assertViewIs('auth.reset-password')
            ->assertSee('Сброс пароля');
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_password_reset(): void
    {
        $user = UserFactory::new()->create(['email' => self::EMAIL]);
        $this->request['token'] = Password::createToken($user);
        $this->request['email'] = $user->email;
        Password::shouldReceive('reset')
            ->withSomeOfArgs()
            ->once()
            ->andReturn(Password::PASSWORD_RESET);

        $response = $this->post(action([ResetPasswordController::class, 'handle']), $this->request);

        $response->assertRedirect(action([SignInController::class, 'page']));
    }

    /**
     * @test
     */
    public function is_authenticated_user_redirected(): void
    {
        $password = '12345678';
        $user = $this->createUser($password);

        $response = $this->actingAs($user)
            ->get(action([ResetPasswordController::class, 'page'], $this->getParams));

        $response->assertRedirect(route('home'));
    }
}