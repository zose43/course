<?php

namespace App\Models;

use App\Traits\Models\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use GenerateSlug;

    protected $fillable = [
        'title',
        'thumbnail',
        'repeat_count',
    ];

    protected $hidden = ['repeat_count'];

    protected static function slugAttributeName(): string
    {
        return 'title';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}