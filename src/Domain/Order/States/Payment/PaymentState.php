<?php

declare(strict_types = 1);

namespace Domain\Order\States\Payment;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PaymentState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(PaymentState::class)
            ->allowTransition(PendingPaymentState::class, CancelledPaymentState::class)
            ->allowTransition(PendingPaymentState::class, PaidPaymentState::class);
    }

    abstract public function name(): string;
}