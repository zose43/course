<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Domain\Product\ViewModels\ProductViewModel;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $viewModel = ProductViewModel::make($product);

        /** last views */
        session()->put('also.' . $product->id, $product->id);

        return view('product.shared.show', [
            'product' => $product,
            'options' => $viewModel->options(),
            'lastView' => $viewModel->lastView(),
        ]);
    }
}