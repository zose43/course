<?php

declare(strict_types = 1);

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Models\Payment;
use Domain\Order\DTOs\PaymentDataDTO;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\Payment\PaidPaymentState;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessException;
use Domain\Order\Exceptions\PaymentProviderException;

final class PaymentSystem
{
    protected static PaymentGatewayContract $provider;
    protected static PaymentEventsManager $eventsManager;

    public static function eventManager(PaymentEventsManager $eventsManager): void
    {
        self::$eventsManager = $eventsManager;
    }

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

    public static function create(): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            PaymentProviderException::providerRequired();
        }

        Payment::query()->create();
        $data = new PaymentDataDTO();

        $closure = PaymentEventsManager::getOnCreating();
        if (is_callable($closure)) {
            $paymentData = $closure();
        }

        return self::$provider->data($paymentData);
    }

    public static function validate(): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            PaymentProviderException::providerRequired();
        }

        PaymentHistory::query()->create([
            'method' => request()?->method(),
            'payload' => self::$provider->request(),
            'payment_gateway' => get_class(self::$provider)
        ]);

        if (self::$provider->validate() && self::$provider->paid()) {
            try {
                $payment = Payment::query()->where('id', self::$provider->paymentId())
                    ->firstOr(fn() => throw PaymentProcessException::wrongPayment());

                if (is_callable(PaymentEventsManager::getOnSuccess())) {
                    PaymentEventsManager::getOnSuccess()();
                }

                $payment->state->transitionTo(PaidPaymentState::class);
            } catch (PaymentProcessException $e) {
                if (is_callable(PaymentEventsManager::getOnError())) {
                    PaymentEventsManager::getOnSuccess()(
                        self::$provider->errorMessage() ?? $e->getMessage()
                    );
                }

                // todo change state to cancelled
            }
        }

        return self::$provider;
    }
}