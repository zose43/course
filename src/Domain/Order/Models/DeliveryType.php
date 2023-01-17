<?php

namespace Domain\Order\Models;

use Support\Casts\PriceCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Domain\Order\QueryBuilders\DeliveryTypeQueryBuilder;

/**
 * @method DeliveryTypeQueryBuilder query()
 */
class DeliveryType extends Model
{
    protected $fillable = [
        'price',
        'title',
        'with_address',
    ];

    protected $casts = [
        'price' => PriceCast::class,
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new DeliveryTypeQueryBuilder($query);
    }
}