<?php

declare(strict_types = 1);

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatuses;

final class PaidOrderState extends OrderState
{
    protected array $allowedTransitions = [
        CancelledOrderState::class,
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): string
    {
        return (OrderStatuses::Paid)->value;
    }

    public function humanValue(): string
    {
        return 'Оплачено';
    }
}