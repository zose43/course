<?php

namespace Domain\Cart\Models;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    use MassPrunable;

    protected $fillable = [
        'storage_id',
        'user_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function prunable(): Builder
    {
        return static::query()->where('created_at', '<=', now()->subWeek());
    }
}