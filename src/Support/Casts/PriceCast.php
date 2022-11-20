<?php

namespace Support\Casts;

use Support\ValueObjects\Price;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PriceCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): Price
    {
        return Price::make($value);
    }

    public function set($model, $key, $value, $attributes): int
    {
        if (!$value instanceof Price) {
            $value = Price::make($value);
        }

        return $value->getRaw();
    }
}