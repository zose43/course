<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

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