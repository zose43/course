<?php

declare(strict_types = 1);

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatuses;

final class CancelledOrderState extends OrderState
{
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return (OrderStatuses::Cancelled)->value;
    }

    public function humanValue(): string
    {
        return 'Отменено';
    }
}