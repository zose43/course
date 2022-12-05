<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        $products = Product::query()
            ->select(['thumbnail', 'title', 'price'])
            ->paginate(6);

        $brands = Brand::query()
            ->select(['title', 'id'])
            ->has('products')
            ->get();

        $categories = Category::query()
            ->select(['title', 'slug'])
            ->has('products')
            ->get();

        return view('catalog.index', compact(
            'products',
            'brands',
            'categories',
            'category'
        ));
    }
}