<?php

namespace Domain\Order\Contracts;

use Illuminate\Http\JsonResponse;
use Domain\Order\DTOs\PaymentDataDTO;

interface PaymentGatewayContract
{
    public function paymentId(): string;

    public function configure(array $config): void;

    public function data(PaymentDataDTO $data): self;

    public function request(): mixed;

    public function response(): JsonResponse;

    public function url(): string;

    public function validate(): bool;

    public function paid(): bool;

    public function errorMessage(): string;
}