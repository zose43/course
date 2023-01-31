<?php

declare(strict_types = 1);

namespace Domain\Order\Processes;

use Exception;
use DomainException;
use Support\Transaction;
use Domain\Order\Models\Order;
use Illuminate\Pipeline\Pipeline;
use Domain\Order\Events\OrderCreatedEvent;

final class OrderProcess
{
    protected array $processes = [];

    public function __construct(public Order $order) {}

    public function processes(array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }

    public function dispatch(): Order
    {
        return Transaction::run(
            function () {
                return app(Pipeline::class)
                    ->send($this->order)
                    ->through($this->processes)
                    ->thenReturn();
            },
            static function (Order $order) {
                flash()->info("Заказ #$order->id создан успешно");
                event(new OrderCreatedEvent($order));
            },
            static function (Exception $e) {
                $message = app()->isProduction() ? 'Что-то пошло не так, попробуйте еще раз' : $e->getMessage();
                throw new DomainException($message);
            });
    }
}