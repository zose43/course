<?php

declare(strict_types = 1);

namespace App\Filters;

use Domain\Catalog\Filters\BaseFilter;
use Domain\Catalog\ViewModels\BrandViewModel;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BrandFilter extends BaseFilter
{
    public const COLUMN = 'brand_id';

    public function title(): string
    {
        return 'Бренды';
    }

    public function key(): string
    {
        return 'brands';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $q) {
            $q->whereIn(self::COLUMN, $this->requestValue());
        });
    }

    public function values(): array
    {
        return BrandViewModel::make()
            ->catalog()
            ->pluck('title', 'id')
            ->toArray();
    }

    public function view(): string
    {
        return 'catalog.filters.brand';
    }
}