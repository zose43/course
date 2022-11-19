<?php

namespace Domain\Auth\DTOs;

use Support\Traits\Makeable;
use Illuminate\Foundation\Http\FormRequest;

class NewUserDTO
{
    use Makeable;

    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $name,
    ) {}

    public static function fromRequest(FormRequest $request): self
    {
        return self::make(...$request->only([
            'email',
            'password',
            'name',
        ]));
    }
}