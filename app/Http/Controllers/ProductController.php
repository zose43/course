<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        if (session()->has('also')) {
            $lastView = Product::query()
                ->select(['thumbnail', 'title', 'price', 'slug'])
                ->whereIn('id', session('also'))
                ->limit(4)
                ->get();
        }

        $product->load('optionValues.option');
        $options = $product->optionValues->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });

        /** last views */
        session()->put('also.' . $product->id, $product->id);

        return view('product.shared.show', [
            'product' => $product,
            'options' => $options,
            'lastView' => $lastView ?? collect([]),
        ]);
    }
}