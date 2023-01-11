<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderCustomer extends Model
{
    protected $fillable = [
        'order_id',
        'city',
        'phone',
        'last_name',
        'first_name',
        'address',
        'email',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}