<?php

namespace App\Models;

use App\Traits\Models\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use GenerateSlug;

    protected $fillable = [
        'title',
        'brand_id',
        'price',
        'thumbnail',
        'repeat_count'
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
}
