<?php

declare(strict_types = 1);

namespace Domain\Order\Payment\Gateways;

use Illuminate\Http\JsonResponse;
use Domain\Order\DTOs\PaymentDataDTO;
use Domain\Order\Contracts\PaymentGatewayContract;

final class YooKassa implements PaymentGatewayContract
{
    public function paymentId(): string
    {
        // TODO: Implement paymentId() method.
    }

    public function configure(array $config): void
    {
        // TODO: Implement configure() method.
    }

    public function data(PaymentDataDTO $data): PaymentGatewayContract
    {
        // TODO: Implement data() method.
    }

    public function request(): mixed
    {
        // TODO: Implement request() method.
    }

    public function response(): JsonResponse
    {
        // TODO: Implement response() method.
    }

    public function url(): string
    {
        // TODO: Implement url() method.
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }

    public function paid(): bool
    {
        // TODO: Implement paid() method.
    }

    public function errorMessage(): string
    {
        // TODO: Implement errorMessage() method.
    }
}