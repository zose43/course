<?php

namespace Domain\Product\ViewModels;

use Support\Traits\DTOs\Makeable;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductViewModel
{
    use Makeable;

    public function __construct(public ?Product $product = null) {}

    public function lastView(): Collection|array
    {
        if (session()->has('also')) {
            $items = array_slice(session('also'), -5);

            return Product::query()
                ->viewed($this->product, $items)
                ->get();
        }

        return Collection::empty();
    }

    public function options(): \Illuminate\Support\Collection
    {
        $this->product->load('optionValues.option');

        return $this->product->optionValues->keyValue();
    }

    public function homePage(): Collection|array
    {
        return Product::query()
            ->homePage()
            ->get();
    }
}