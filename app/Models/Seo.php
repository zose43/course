<?php

namespace App\Models;

use Support\Casts\SeoCast;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    public const CACHE_KEY_TAG = 'seo';
    public const CACHE_KEY_PREFIX = 'seo_';

    protected $table = 'seo';

    protected $fillable = [
        'title',
        'url'
    ];

    protected $casts = [
        'url' => SeoCast::class
    ];
}