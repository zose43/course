<?php

namespace App\Models;

use App\Traits\Models\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use GenerateSlug;

    protected $fillable = [
        'title',
        'repeat_count',
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
}
