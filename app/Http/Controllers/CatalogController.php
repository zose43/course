<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        $products = Product::query()
            ->select(['thumbnail', 'title', 'price', 'slug'])
            ->when(request('s'), function (Builder $query) {
                $query->whereFullText(['text', 'title'], request('s'));
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

        $brands = BrandViewModel::make()
            ->catalog();

        $categories = CategoryViewModel::make()
            ->catalog();

        return view('catalog.index', compact(
            'products',
            'brands',
            'categories',
            'category'
        ));
    }
}