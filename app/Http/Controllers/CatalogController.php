<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\CategoryViewModel;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        $products = Product::query()
            ->withCategory($category)
            ->search()
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