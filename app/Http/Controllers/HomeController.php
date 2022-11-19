<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $brands = Brand::query()->homePage()->get();
        $categories = Category::query()->homePage()->get();
        $products = Product::query()->homePage()->get();

        return view('index', compact('products', 'categories', 'brands'));
    }
}