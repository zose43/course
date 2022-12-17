<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Product\ViewModels\ProductViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $brands = BrandViewModel::make()
            ->homePage();

        $categories = CategoryViewModel::make()
            ->homePage();

        $products = ProductViewModel::make()
            ->homePage();

        return view('index', compact(
            'products',
            'categories',
            'brands'));
    }
}