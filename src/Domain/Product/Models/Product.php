<?php

namespace Domain\Product\Models;

use Support\Casts\PriceCast;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use App\Jobs\ProductJsonPropertiesJob;
use Support\Traits\Models\GenerateSlug;
use Support\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Domain\Product\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static Product|ProductQueryBuilder query()
 */
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
        'text',
        'json_properties',
        'quantity',
    ];

    protected $casts = [
        'price' => PriceCast::class,
        'json_properties' => 'array',
    ];

    protected $hidden = ['repeat_count'];

    protected static function slugAttributeName(): string
    {
        return 'title';
    }

    protected static function boot(): void
    {
        parent::boot();

        self::created(static function (Product $product) {
            dispatch(new ProductJsonPropertiesJob($product))
                ->delay(now()->addSeconds(10));
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('value');
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }

    public function newEloquentBuilder($query): Builder
    {
        return new ProductQueryBuilder($query);
    }
}
