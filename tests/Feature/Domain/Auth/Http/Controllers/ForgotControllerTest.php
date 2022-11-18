<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
    public function is_reset_link_sent(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()->with($this->request)->andReturn('passwords.sent');

        $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);
    }

    /**
     * @test
     * @covers ForgotPasswordController::handle
     */
    public function is_forgot_handle_success(): void
    {
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $this->request);

        $response->assertValid()->
        assertSessionHasNoErrors();
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
}