<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Domain\Auth\DTOs\NewUserDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;

class SignUpController extends Controller
{
    public function page(): View
    {
        return view('auth.sign-up');
    }

    public function handle(SignUpFormRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        $newUserDTO = NewUserDTO::fromRequest($request);

        /** @var RegisterNewUserAction $action */
        $user = $action($newUserDTO);
        event(new Registered($user));
        auth()->login($user);

        return redirect()->intended(route('home'));
    }
}