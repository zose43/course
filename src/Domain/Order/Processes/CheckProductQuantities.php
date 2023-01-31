<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Models\Order;
use Domain\Cart\Models\CartItem;
use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProcessException;

final class CheckProductQuantities implements OrderProcessContract
{
    public function handle(Order $order, $next): Order
    {
        foreach (cart()->items() as $item) {
            /** @var $item CartItem */
            if ($item->product->quantity < $item->quantity) {
                throw (new OrderProcessException('Quantity is empty for ' . $item->product->id));
            }
        }

        return $next($order);
    }
}