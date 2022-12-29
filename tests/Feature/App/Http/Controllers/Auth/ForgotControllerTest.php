<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Support\Facades\Password;

/**
 * @coversDefaultClass ForgotPasswordController
 */
class ForgotControllerTest extends BaseAuthController
{
    protected function setUp(): void
    {
        parent::setUp();

        UserFactory::new()->create(['email' => self::EMAIL]);
        $this->request = ['email' => self::EMAIL];
    }

    /**
     * @test
     */
    public function is_forgot_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))->assertOk();
    }

    /**
     * @test
     */
    public function is_forgot_view(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertViewIs('auth.forgot-password')
            ->assertSee('Восстановить пароль');
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_email_invalid(): void
    {
        $this->request = ['email' => 'no@ya.ru'];
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);

        $response->assertInvalid()
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_forgot_handle_success(): void
    {
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);

        $response->assertValid();
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_notification_send(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()->with($this->request)->andReturn('passwords.sent');

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_flash_msg_appear(): void
    {
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);

        $response->assertSessionHas('course_flash_msg', 'We have emailed your password reset link!');
    }

    /**
     * @test
     */
    public function is_authenticated_user_redirected(): void
    {
        $user = User::query()
            ->where('email', self::EMAIL)
            ->first();

        $response = $this->actingAs($user)
            ->get(action([ForgotPasswordController::class, 'page']));

        $response->assertRedirect(route('home'));
    }
}