<?php

namespace Domain\Cart\Models;

use Support\Casts\PriceCast;
use Support\ValueObjects\Price;
use Domain\Product\Models\Product;
use Domain\Product\Models\OptionValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'string_option_values',
        'price',
        'product_id',
        'quantity',
    ];

    protected $casts = [
        'price' => PriceCast::class,
    ];

    public function amount(): Attribute
    {
        return Attribute::get(fn() => Price::make($this->price->getRaw() * $this->quantity));
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }
}