<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use DomainException;
use Support\SessionRegenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Domain\Auth\Actions\GithubCallbackAction;
use Domain\Auth\Contracts\SocialiteCallbackContract;

class SocialAuthController extends Controller
{
    public const GITHUB = 'github';

    public function redirect(string $driver): RedirectResponse
    {
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Throwable $e) {
            throw new DomainException('Произошла ошибка');
        }
    }

    public function callback(string $driver, SocialiteCallbackContract $action): RedirectResponse
    {
        if ($driver !== self::GITHUB) {
            throw new DomainException('Драйвер не поддерживается');
        }

        /** @var GithubCallbackAction $action */
        $user = $action($driver);

        SessionRegenerator::run(
            static fn() => auth()->login($user));

        return redirect()->intended(route('home'));
    }
}