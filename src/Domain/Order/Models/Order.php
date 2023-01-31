<?php

namespace Domain\Order\Models;

use Domain\Auth\Models\User;
use Support\Casts\PriceCast;
use Domain\Order\States\OrderState;
use Domain\Order\Enums\OrderStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property OrderState $status
 */
class Order extends Model
{
    protected $fillable = [
        'amount',
        'user_id',
        'delivery_type_id',
        'payment_method_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    protected $casts = [
        'amount' => PriceCast::class,
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => OrderStatuses::from($value)
                ->createState($this),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer(): HasOne
    {
        return $this->hasOne(OrderCustomer::class);
    }
}