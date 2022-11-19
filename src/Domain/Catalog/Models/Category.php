<?php

namespace Domain\Catalog\Models;

use App\Models\Product;
use Support\Traits\Models\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use GenerateSlug;

    protected $fillable = [
        'title',
        'repeat_count',
        'on_main_page',
        'sorting',
    ];

    protected $hidden = ['repeat_count'];

    protected static function slugAttributeName(): string
    {
        return 'title';
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeHomePage(Builder $query): Builder
    {
        return $query->where('on_main_page', true)->orderBy('sorting')->limit(10);
    }
}
