<?php

namespace App\Observers;

use App\Models\Seo;
use Illuminate\Support\Facades\Cache;

class SeoObserver
{
    private function forget(Seo $seo): void
    {
        $slug = str($seo->url)->slug('_');
        Cache::forget(Seo::CACHE_KEY_PREFIX . $slug);
    }

    public function created(Seo $seo): void
    {
        $this->forget($seo);
    }

    public function updated(Seo $seo): void
    {
        $this->forget($seo);
    }

    public function deleted(Seo $seo): void
    {
        $this->forget($seo);
    }
}