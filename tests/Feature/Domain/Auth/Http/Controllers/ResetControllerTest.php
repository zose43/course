<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

class ResetControllerTest extends BaseAuthController
{
    /**
     * @test
     */
    public function is_forgot_page_success(): void
    {
        //todo get data from forgot.handler test (token,email)
        $this->get(action([ResetPasswordController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.reset-password')
            ->assertSee('Сброс пароля');
    }
}