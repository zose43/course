<?php

namespace App\Models;

use Support\Casts\PriceCast;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Support\Traits\Models\GenerateSlug;
use Support\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use GenerateSlug;
    use HasThumbnail;

    public const THUMBNAIL_DIR = 'products';

    protected $fillable = [
        'title',
        'brand_id',
        'price',
        'thumbnail',
        'repeat_count',
        'on_main_page',
        'sorting',
    ];

    protected $casts = [
        'price' => PriceCast::class,
    ];

    protected $hidden = ['repeat_count'];

    protected static function slugAttributeName(): string
    {
        return 'title';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeHomePage(Builder $query): Builder
    {
        return $query->where('on_main_page', true)->orderBy('sorting')->limit(6);
    }
}
