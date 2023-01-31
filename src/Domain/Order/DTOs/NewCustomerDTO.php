<?php

declare(strict_types = 1);

namespace Domain\Order\DTOs;

use App\Contracts\DTO;
use Support\Traits\DTOs\Makeable;
use App\Http\Requests\OrderFormRequest;
use Illuminate\Foundation\Http\FormRequest;

final class NewCustomerDTO implements DTO
{
    use Makeable;

    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $phone,
        public readonly string $email,
        public readonly ?string $city,
        public readonly ?string $address,
    ) {}

    public static function fromRequest(FormRequest $request): DTO
    {
        /** @var $request OrderFormRequest */
        return self::make(
            ... array_values($request->get('customer'))
        );
    }

    public function getProperties(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
        ];
    }
}