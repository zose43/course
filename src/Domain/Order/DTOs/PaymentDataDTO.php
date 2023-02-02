<?php

declare(strict_types = 1);

namespace Domain\Order\DTOs;

use Support\ValueObjects\Price;
use Illuminate\Support\Collection;

final class PaymentDataDTO
{
    public function __construct(
        public string     $id,
        public string     $description,
        public string     $returnUrl,
        public Price      $amount,
        public Collection $meta
    ) {}

    public function all(): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'returnUrl' => $this->returnUrl,
            'amount' => $this->amount,
            'meta' => $this->meta,
        ];
    }
}