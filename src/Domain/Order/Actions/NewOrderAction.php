<?php

declare(strict_types = 1);

namespace Domain\Order\Actions;

use App\Contracts\DTO;
use Domain\Order\Models\Order;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\DTOs\NewOrderDTO;
use Domain\Auth\Contracts\RegisterNewUserContract;

final class NewOrderAction
{
    /**
     * @var NewOrderDTO $dto
     */
    public function __invoke(DTO $dto): Order
    {
        if ($dto->isNewUser()) {
            $registerAction = app()->make(RegisterNewUserContract::class);
            $newUserDto = NewUserDTO::make(
                $dto->email,
                $dto->password,
                "$dto->firstName $dto->lastName"
            );

            $registerAction($newUserDto);
        }

        return (new Order())->query()
            ->create([
                'payment_method_id' => $dto->payment,
                'delivery_type_id' => $dto->delivery,
            ]);
    }
}