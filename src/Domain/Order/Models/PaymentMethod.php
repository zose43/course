<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'title',
        'redirect_to_pay'
    ];
}