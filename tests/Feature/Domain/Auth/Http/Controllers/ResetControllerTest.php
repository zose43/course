<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

class ResetControllerTest extends BaseAuthController
{
    /**
     * @test
     */
    public function is_forgot_page_success(): void
    {
        $this->get(route('reset', ['token' => 'test_token', 'email' => 'test@ya.ru']))
            ->assertOk()
            ->assertViewIs('auth.reset-password')
            ->assertSee('Сброс пароля');
    }

    public function is_forgot_page_handle_success(): void {}
}