<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\View\View;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $brands = BrandViewModel::make()
            ->homePage();

        $categories = CategoryViewModel::make()
            ->homePage();

        $products = Product::query()
            ->homePage()
            ->get();

        return view('index', compact('products', 'categories', 'brands'));
    }
}