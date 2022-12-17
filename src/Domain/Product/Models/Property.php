<?php

namespace Domain\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Domain\Product\Collections\PropertyCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @see PropertyCollection
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function newCollection(array $models = []): Collection
    {
        return new PropertyCollection($models);
    }
}