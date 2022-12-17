<?php

namespace Domain\Catalog\Models;

use Domain\Product\Models\Product;
use Support\Traits\Models\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Domain\Catalog\Collections\CategoryCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Domain\Catalog\QueryBuilders\CategoryQueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static CategoryQueryBuilder|Category query()
 */
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

    public function newEloquentBuilder($query): Builder
    {
        return new CategoryQueryBuilder($query);
    }

    public function newCollection(array $models = []): Collection
    {
        return new CategoryCollection($models);
    }
}
