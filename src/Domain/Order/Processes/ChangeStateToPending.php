<?php

declare(strict_types = 1);

namespace Domain\Order\Processes;

use Domain\Order\Models\Order;
use Domain\Order\States\PendingOrderState;
use Domain\Order\Contracts\OrderProcessContract;

final class ChangeStateToPending implements OrderProcessContract
{

    public function handle(Order $order, $next): Order
    {
        $order->status
            ->transitionTo(new PendingOrderState($order));

        return $next($order);
    }
}