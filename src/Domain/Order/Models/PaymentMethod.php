<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Domain\Order\QueryBuilders\PaymentMethodQueryBuilder;

/**
 * @method PaymentMethodQueryBuilder query()
 */
class PaymentMethod extends Model
{
    protected $fillable = [
        'title',
        'redirect_to_pay',
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new PaymentMethodQueryBuilder($query);
    }
}