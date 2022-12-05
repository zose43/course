<?php

namespace Tests\Feature\Domain\Auth\Http\Controllers;

use Event;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\SignUpFormRequest;
use App\Notifications\NewUserNotification;
use App\Listeners\SendEmailNewUserListener;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Auth\SignUpController;

/**
 * @coversDefaultClass SignUpController
 */
class SignUpControllerTest extends BaseAuthController
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->request = SignUpFormRequest::factory()->create([
            'email' => self::EMAIL,
        ]);
    }

    protected function initEvent(User $user): void
    {
        $event = new Registered($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);
    }

    /**
     * @test
     */
    public function is_sign_up_page_success(): void
    {
        $this->get(action([SignUpController::class, 'page']))->assertOk();
    }

    /**
     * @test
     */
    public function is_sign_up_page_view(): void
    {
        $this->get(action([SignUpController::class, 'page']))
            ->assertViewIs('auth.sign-up')
            ->assertSee('Регистрация');
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_database_missing(): void
    {
        $this->assertDatabaseMissing(self::TABLE, ['email' => $this->request['email']]);
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_credentials_pass(): void
    {
        $response = $this->post(action([SignUpController::class, 'handle']), $this->request);
        $response->assertValid();
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_database_has(): void
    {
        $this->post(action([SignUpController::class, 'handle']), $this->request);
        $this->assertDatabaseHas(self::TABLE, ['email' => $this->request['email']]);
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_event_trigger(): void
    {
        Event::fake();
        $this->post(action([SignUpController::class, 'handle']), $this->request);
        $user = User::query()->where('email', self::EMAIL)->first();
        $this->initEvent($user);
        Event::assertDispatchedTimes(Registered::class);
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_event_listener_exist(): void
    {
        Event::fake();
        $this->post(action([SignUpController::class, 'handle']), $this->request);
        $user = User::query()->where('email', self::EMAIL)->first();
        $this->initEvent($user);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);
    }

    /**
     * @test
     * @covers SignUpController::handle
     */
    public function is_notification_send(): void
    {
        $this->post(action([SignUpController::class, 'handle']), $this->request);
        $user = User::query()->where('email', self::EMAIL)->first();
        $this->initEvent($user);
        Notification::assertSentTo($user, NewUserNotification::class);
    }

    /**
     * @test
     */
    public function is_sign_up_handle_success(): void
    {
        $response = $this->post(action([SignUpController::class, 'handle']), $this->request);
        $user = User::query()->where('email', self::EMAIL)->first();
        $this->assertAuthenticatedAs($user);

        $response->assertValid()
            ->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function is_authenticated_as(): void
    {
        $this->post(action([SignUpController::class, 'handle']), $this->request);
        $user = User::query()->where('email', self::EMAIL)->first();

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function is_sign_up_handle_failure(): void
    {
        $response = $this->post(action([SignUpController::class, 'handle']), []);

        $response->assertInvalid();
    }

    /**
     * @test
     */
    public function is_authenticated_user_redirected(): void
    {
        $password = '12345678';
        $user = $this->createUser($password);

        $response = $this->actingAs($user)
            ->get(action([SignUpController::class, 'page']));

        $response->assertRedirect(route('home'));
    }
}