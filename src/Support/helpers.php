<?php

use Support\Flash\Flash;
use Domain\Catalog\Filters\FilterManager;

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if (!function_exists('filters')) {
    function filters(): array
    {
        return app(FilterManager::class)->items();
    }
}

if (!function_exists('convertPrice')) {
    function convertPrice(int $value): int
    {
        return $value * 100;
    }
}
