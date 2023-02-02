<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'method',
        'payload',
        'payment_gateway'
    ];

    protected $casts = [
        'payload' => 'collection'
    ];
}