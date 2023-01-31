<?php

declare(strict_types = 1);

namespace Domain\Order\Processes;

use App\Contracts\DTO;
use Domain\Order\Models\Order;
use Domain\Order\Contracts\OrderProcessContract;

final class AssignCustomer implements OrderProcessContract
{
    public function __construct(protected DTO $customer) {}

    public function handle(Order $order, $next): Order
    {
        $order->customer()
            ->create(($this->customer->getProperties()));

        return $next($order);
    }
}