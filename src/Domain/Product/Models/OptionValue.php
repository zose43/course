<?php

namespace Domain\Product\Models;

use Domain\Cart\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Domain\Product\Collections\OptionValueCollection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @see OptionValueCollection
 */
class OptionValue extends Model
{
    protected $fillable = [
        'title',
        'option_id',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function newCollection(array $models = []): Collection
    {
        return new OptionValueCollection($models);
    }

    public function cartItems(): BelongsToMany
    {
        return $this->belongsToMany(CartItem::class);
    }
}