<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use App\Http\Requests\SignUpFormRequest;
use App\Http\Controllers\Auth\SignInController;

class LoginControllerTest extends BaseAuthController
{
    /**
     * @test
     */
    public function is_login_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.login')
            ->assertSee('Вход в аккаунт');
    }

    /**
     * @test
     */
    public function is_login_handle_success(): void
    {
        $password = '12345678';
        $user = $this->createUser($password);
        $request = SignUpFormRequest::factory()->create([
            'email' => $user->email,
            'password' => $password,
        ]);

        $response = $this->post(action([SignInController::class, 'handle']), $request);

        $response->assertValid()->
        assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function is_login_handle_failed(): void
    {
        $request = SignUpFormRequest::factory()->create();
        $response = $this->post(action([SignInController::class, 'handle']), $request);

        $response->assertInvalid()->
        assertSessionHasErrors(['email' => 'Неверно введены данные']);

        $this->assertGuest();
    }

    /**
     * @test
     */
    public function is_logout_success(): void
    {
        $password = '12345678';
        $user = $this->createUser($password);

        $response = $this->actingAs($user)->
        delete(action([SignInController::class, 'logOut']));

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }
}