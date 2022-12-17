<?php

use Support\Flash\Flash;
use App\Breadcrumbs\BreadCrumb;
use Domain\Catalog\Models\Category;
use App\Breadcrumbs\BreadCrumbItem;
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
                ...request()?->only(['filters', 'sort', 's']),
                ...$params,
                'category' => $category,
            ]);
        }
    }

    if (!function_exists('breadcrumbs')) {
        function breadcrumbs(string $label, string $route): BreadCrumb
        {
            // TODO fx breadcrumbs
            return BreadCrumb::make()
                ->add(BreadCrumbItem::make('Главная', route('home')))
                ->add(BreadCrumbItem::make('Каталог', route('catalog')))
                ->addIf(str(request()?->path())->contains('catalog'),
                    BreadCrumbItem::make($label, $route))
                ->addIf(str(request()?->path())->contains('product'),
                    BreadCrumbItem::make($label, $route));
        }
    }
}
