<?php

namespace Domain\Order\Models;

use Support\Casts\PriceCast;
use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $fillable=[
        'price',
        'title',
        'with_address'
    ];

    protected $casts=[
        'price' => PriceCast::class
    ];
}