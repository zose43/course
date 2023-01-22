<?php

namespace Domain\Auth\DTOs;

use App\Contracts\DTO;
use Support\Traits\DTOs\Makeable;
use Illuminate\Foundation\Http\FormRequest;

class NewUserDTO implements DTO
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

    public function getProperties(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->name,
        ];
    }
}