<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Domain\Auth\Contracts\SocialiteCallbackContract;

class GithubCallbackAction implements SocialiteCallbackContract
{
    public function __invoke(string $driver): void
    {
        $githubUser = Socialite::driver($driver)->user();
        /**
         * create socialite table, user table has relations
         */
        $user = User::query()->updateOrCreate([
            $driver . '_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name ?? "user_$githubUser->id",
            'email' => $githubUser->email,
            'password' => bcrypt(str()->random(20)),
        ]);

        auth()->login($user);
    }
}