<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Domain\Auth\Contracts\SocialiteCallbackContract;

class GithubCallbackAction implements SocialiteCallbackContract
{
    public function __invoke(string $driver): User
    {
        $githubUser = Socialite::driver($driver)->user();

        /**
         * create socialite table, user table has relations
         */
        return User::query()->updateOrCreate([
            $driver . '_id' => $githubUser->getId(),
        ], [
            'name' => $githubUser->getName() ?? ('user_' . $githubUser->getId()),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt(str()->random(20)),
        ]);
    }
}