<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_id',
        'gateway',
        'meta'
    ];
}