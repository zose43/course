<?php

namespace Support\Traits\Models;

use Illuminate\Support\Facades\Cache;

trait FlushCache
{
    protected function flush(string|array $keys): void
    {
        Cache::tags($keys)->flush();
    }
}