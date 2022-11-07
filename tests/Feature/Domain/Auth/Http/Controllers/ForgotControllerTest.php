<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;

class ForgotControllerTest extends BaseAuthController
{
    /**
     * @test
     */
    public function is_forgot_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.forgot-password')
            ->assertSee('Восстановить пароль');
    }

    /**
     * @test
     */
    public function assert_that_email_is_invalid(): void
    {
        $request = ['email' => 'zose@ya.ru'];
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $request);

        $response->assertInvalid()->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function is_forgot_handle_success(): void
    {
        $email = 'zose@ya.ru';
        $request = ['email' => 'zose@ya.ru'];
        UserFactory::new()->create(['email' => $email]);
        Password::shouldReceive('sendResetLink')
            ->once()->with($request)->andReturn('passwords.sent');

        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $request);

        $response->assertValid()->
        assertSessionHasNoErrors()->
        assertSessionHas('course_flash_msg', 'We have emailed your password reset link!');
    }
}