<?php

declare(strict_types = 1);

namespace Domain\Order\Payment;

use Closure;

final class PaymentEventsManager
{
    protected static Closure $onCreating;
    protected static Closure $onSuccess;
    protected static Closure $onValidating;
    protected static Closure $onError;

    public static function getOnSuccess(): Closure
    {
        return self::$onSuccess;
    }

    public static function getOnValidating(): Closure
    {
        return self::$onValidating;
    }

    public static function getOnError(): Closure
    {
        return self::$onError;
    }

    public static function getOnCreating(): Closure
    {
        return self::$onCreating;
    }

    public static function setOnCreating(Closure $event): void
    {
        self::$onCreating = $event;
    }

    public static function setOnSuccess(Closure $event): void
    {
        self::$onSuccess = $event;
    }

    public static function setOnValidating(Closure $event): void
    {
        self::$onValidating = $event;
    }

    public static function setOnError(Closure $event): void
    {
        self::$onError = $event;
    }
}