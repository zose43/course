<?php

namespace Support\ValueObjects;

use Stringable;
use InvalidArgumentException;
use Support\Traits\DTOs\Makeable;

class Price implements Stringable
{
    use Makeable;

    private array $currencies = [
        'RUB' => '₽',
    ];

    public function __construct(
        private readonly int $value,
        private readonly string $currency = 'RUB',
        private readonly int $precision = 100,
    )
    {
        if ($this->value < 0) {
            throw new InvalidArgumentException('Price must be more than 0!');
        }
        if (!isset($this->currencies[$this->currency])) {
            throw new InvalidArgumentException('Currency is not supported');
        }
    }

    public function getRaw(): int
    {
        return $this->value;
    }

    public function getValue(): float|int
    {
        return $this->value / $this->precision;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCurrencySymbol(): string
    {
        return $this->currencies[$this->currency];
    }

    public function __toString(): string
    {
        return number_format($this->value, 2, ',', ' ') . ' ' . $this->getCurrencySymbol();
    }
}