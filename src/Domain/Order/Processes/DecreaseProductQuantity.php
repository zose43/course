<?php

declare(strict_types=1);

namespace Domain\Order\Processes;

use DB;
use Domain\Order\Models\Order;
use Domain\Cart\Models\CartItem;
use Domain\Order\Contracts\OrderProcessContract;

final class DecreaseProductQuantity implements OrderProcessContract
{
    public function handle(Order $order, $next): Order
    {
        foreach (cart()->items() as $item) {
            /** @var $item CartItem */
            $item->product()
                ->update([
                    'quantity' => DB::raw('quantity - ' . $item->quantity
                    )]);
        }

        return $next($order);
    }
}