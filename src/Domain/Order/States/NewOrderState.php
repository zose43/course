<?php

declare(strict_types = 1);

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatuses;

final class NewOrderState extends OrderState
{
    protected array $allowedTransitions = [
        PendingOrderState::class,
        CancelledOrderState::class,
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return (OrderStatuses::New)->value;
    }

    public function humanValue(): string
    {
        return 'Новый заказ';
    }
}