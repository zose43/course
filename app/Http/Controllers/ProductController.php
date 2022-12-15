<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        if (session()->has('also')) {
            $items = array_slice(session('also'), -5);
            $lastView = Product::query()
                ->select(['thumbnail', 'title', 'price', 'slug'])
                ->where(function (Builder $q) use (&$product, $items) {
                    $q->whereIn('id', $items)
                        ->whereNot('id', $product->id);
                })
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