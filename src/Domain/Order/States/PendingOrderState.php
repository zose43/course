<?php

declare(strict_types = 1);

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatuses;

final class PendingOrderState extends OrderState
{
    protected array $allowedTransitions = [
        CancelledOrderState::class,
        PaidOrderState::class,
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return (OrderStatuses::Pending)->value;
    }

    public function humanValue(): string
    {
        return 'Заказ в обработке';
    }
}