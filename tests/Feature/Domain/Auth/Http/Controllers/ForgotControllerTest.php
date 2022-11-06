<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

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
}