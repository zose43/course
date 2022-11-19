<?php

namespace Support\Traits\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

trait GenerateSlug
{
    abstract protected static function slugAttributeName(): string;

    protected static function bootGenerateSlug(): void
    {
        self::creating(static function (Model $model) {
            $slug = str($model->{self::slugAttributeName()})->slug();
            $count = DB::table('slug')->where('slug', '=', $slug)->first('repeat');

            if ($count) {
                DB::table('slug')->where('slug', '=', $slug)
                    ->increment('repeat');
                $model->slug = $slug . '_' . ((int)$count->repeat + 1);
            } else {
                DB::table('slug')->insert(['slug' => $slug]);
                $model->slug = $slug;
            }
        });
    }
}
