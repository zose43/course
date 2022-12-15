<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Domain\Catalog\ViewModels\CategoryViewModel;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        $products = Product::query()
            ->select(['thumbnail', 'title', 'price', 'slug', 'json_properties'])
            ->when(request('s'), function (Builder $query) {
                $query->whereFullText(['title', 'text'], request('s'));
            })->when($category?->exists, function (Builder $query) use (&$category) {
                $query->whereRelation(
                    'categories',
                    'categories.id',
                    '=',
                    $category->id);
            })
            ->filtered()
            ->sorted()
            ->paginate(6);

        $categories = CategoryViewModel::make()
            ->catalog();

        return view('catalog.index', compact(
            'products',
            'categories',
            'category'
        ));
    }
}