<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;

class CatalogController extends Controller
{
    // TODO cache and select needed query items
    public function __invoke(?Category $category)
    {
        $products = Product::query()
            ->paginate(6);

        $brands = Brand::query()
            ->has('products')
            ->get();

        $categories = Category::query()
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