<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use App\Http\Requests\SignInFormRequest;
use App\Http\Controllers\Auth\SignInController;

/**
 * @coversDefaultClass SignInController
 */
class SignInControllerTest extends BaseAuthController
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SignInFormRequest::factory()->create();
    }

    /**
     * @test
     */
    public function is_login_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))->assertOk();
    }

    /**
     * @test
     */
    public function is_login_page_view(): void
    {
        $this->get(action([SignInController::class, 'page']))
            ->assertViewIs('auth.login')
            ->assertSee('Вход в аккаунт');
    }

    /**
     * @test
     */
    public function is_login_handle_success(): array
    {
        $password = '12345678';
        $user = $this->createUser($password);
        $this->request['email'] = $user->email;
        $this->request['password'] = $password;

        $response = $this->post(action([SignInController::class, 'handle']), $this->request);

        $response->assertValid()->
        assertRedirect(route('home'));

        return $this->request;
    }

    /**
     * @test
     * @depends is_login_handle_success
     */
    public function is_authenticated_as(array $request): void
    {
        $password = '12345678';
        $user = $this->createUser($password);
        $this->post(action([SignInController::class, 'handle']), $request);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function is_login_handle_failed(): void
    {
        $response = $this->post(action([SignInController::class, 'handle']), $this->request);

        $response->assertInvalid()->
        assertSessionHasErrors(['email' => 'Неверно введены данные']);
    }

    /**
     * @test
     */
    public function is_guest(): void
    {
        $this->post(action([SignInController::class, 'handle']), $this->request);

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

        $response->assertRedirect(route('home'));
    }
}