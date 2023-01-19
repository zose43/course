<?php

declare(strict_types = 1);

namespace Domain\Order\States;

use InvalidArgumentException;
use Domain\Order\Models\Order;
use Domain\Order\Events\OrderStatusChangedEvent;

abstract class OrderState
{
    protected array $allowedTransitions = [];

    public function __construct(protected Order $order) {}

    public function transitionTo(OrderState $state): void
    {
        if (!$state->canBeChanged()) {
            throw new InvalidArgumentException('Status can\'t be changed');
        }
        if (!in_array(get_class($state), $this->allowedTransitions, true)) {
            throw new InvalidArgumentException(
                "No transition for {$this->order->status->value()} to {$state->value()}"
            );
        }

        $this->order->updateQuietly([
            'status' => $state->value(),
        ]);

        event(new OrderStatusChangedEvent(
            $this->order,
            $this->order->status,
            $state
        ));
    }

    abstract public function canBeChanged(): bool;

    abstract public function value(): string;

    abstract public function humanValue(): string;
}