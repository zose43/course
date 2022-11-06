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

class SignUpControllerTest extends BaseAuthController
{
    /**
     * @test
     */
    public function is_sign_up_page_success(): void
    {
        $this->get(action([SignUpController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.sign-up')
            ->assertSee('Регистрация');
    }

    /**
     * @test
     */
    public function is_sign_up_handle_success(): void
    {
        $table = 'users';
        Notification::fake();
        Event::fake();

        $request = SignUpFormRequest::factory()->create([
            'email' => 'test@mail.ru',
        ]);

        $this->assertDatabaseMissing($table, ['email' => $request['email']]);

        $response = $this->post(action([SignUpController::class, 'handle']), $request);
        $response->assertValid();

        $this->assertDatabaseHas($table, ['email' => $request['email']]);

        $user = User::query()->where('email', $request['email'])->first();
        $event = new Registered($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);

        Event::assertDispatchedTimes(Registered::class);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);

        Notification::assertSentTo($user, NewUserNotification::class);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }
}