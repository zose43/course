<?php

declare(strict_types = 1);

namespace App\Filters;

use Domain\Catalog\Filters\BaseFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PriceFilter extends BaseFilter
{
    public const COLUMN = 'price';

    public function title(): string
    {
        return 'Цена';
    }

    public function key(): string
    {
        return 'price';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q) {
            $q->whereBetween(self::COLUMN, [
                convertPrice((int)$this->requestValue('from', 0)),
                convertPrice((int)$this->requestValue('to', 100000)),
            ]);
        });
    }

    public function values(): array
    {
        return [
            'from' => 0,
            'to' => 100000,
        ];
    }

    public function view(): string
    {
        return 'catalog.filters.price';
    }
}