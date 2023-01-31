<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Models\Order;
use Domain\Cart\Models\CartItem;
use Domain\Order\Contracts\OrderProcessContract;

final class AssignProducts implements OrderProcessContract
{
    public function handle(Order $order, $next): Order
    {
        $orderItems = cart()->items()
            ->map(static function (CartItem $collection) {
                return $collection->only([
                    'product_id',
                    'price',
                    'quantity',
                ]);
            });

        $order->items()->createMany($orderItems);

        return $next($order);
    }
}