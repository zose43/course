<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        return view('product.shared.show', [
            'product' => $product,
        ]);
    }
}