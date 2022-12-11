<?php

use Support\Flash\Flash;
use Domain\Catalog\Models\Category;
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

    if (!function_exists('productView')) {
        function productView(string $view): bool
        {
            return session('product_view') === $view;
        }
    }

    if (!function_exists('catalogUrl')) {
        function catalogUrl(Category $category, array $params = []): string
        {
            return route('catalog', [
                ...request()?->only(['filters', 'sort']),
                ...$params,
                'category' => $category,
            ]);
        }
    }
}
