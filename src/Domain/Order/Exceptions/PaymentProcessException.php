<?php

declare(strict_types = 1);

namespace Domain\Order\Exceptions;

use Exception;

final class PaymentProcessException extends Exception
{
    public static function wrongPayment(): self
    {
        return new self('Payment not found');
    }
}