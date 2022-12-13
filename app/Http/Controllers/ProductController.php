<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->load('optionValues.option');
        $options = $product->optionValues->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });

        return view('product.shared.show', [
            'product' => $product,
            'options' => $options,
        ]);
    }
}