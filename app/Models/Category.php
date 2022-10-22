<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    protected static function boot(): void
    {
        parent::boot();
        self::creating(static function (Category $category) {
            $category->slug = str($category->title)->slug();
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
