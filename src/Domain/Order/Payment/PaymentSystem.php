<?php

declare(strict_types = 1);

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProviderException;

final class PaymentSystem
{
    protected static PaymentGatewayContract $provider;

    public static function provider(PaymentGatewayContract|Closure $provider): void
    {
        if (is_callable($provider)) {
            $provider = $provider();
        }

        if (!$provider instanceof PaymentGatewayContract) {
            PaymentProviderException::providerRequired();
        }

        self::$provider = $provider;
    }
}