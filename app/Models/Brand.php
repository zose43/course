<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail',
    ];

    protected static function boot(): void
    {
        parent::boot();
        // TODO 3rd lesson
        self::creating(static function (Brand $brand) {
            $brand->slug = str($brand->title)->slug();
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
