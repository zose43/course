<?php

declare(strict_types = 1);

namespace Domain\Order\Actions;

use Domain\Order\Models\Order;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Auth\Contracts\RegisterNewUserContract;

final class NewOrderAction
{
    public function __invoke(NewOrderDTO $dto): Order
    {
        if ($dto->isNewUser()) {
            $registerAction = app()->make(RegisterNewUserContract::class);
            $newUserDto = NewUserDTO::make(
                $dto->email,
                $dto->password,
                "$dto->firstName $dto->lastName"
            );

            auth()->login($registerAction($newUserDto));
        }

        return (new Order())->query()
            ->create([
                'payment_method_id' => $dto->payment,
                'delivery_type_id' => $dto->delivery,
                'user_id' => auth()->check() ? auth()->id() : null
            ]);
    }
}