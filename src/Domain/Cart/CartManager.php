<?php

namespace Domain\Cart;

use DB;
use Domain\Cart\Models\Cart;
use Support\ValueObjects\Price;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Query\Builder;
use Domain\Cart\Contracts\CartIdentityStorageContract;

class CartManager
{
    public function __construct(protected CartIdentityStorageContract $identityStorage) {}

    public function add(Product $product, int $quantity, array $optionValues = []): Cart
    {
        $cart = Cart::updateOrCreate([
            'storage_id' => $this->identityStorage->get(),
        ], [
            $this->storedData($this->identityStorage->get()),
        ]);

        $cartItem = $cart->cartItems()->updateOrCreate([
            'product_id' => $product->id,
            'string_option_values' => $this->stringedOptionValues($optionValues),
        ], [
            'price' => $product->price,
            'quantity' => DB::raw("quantity + $quantity"),
            'string_option_values' => $this->stringedOptionValues($optionValues),
        ]);

        /** sync with product props */
        $cartItem->optionValues()->sync($optionValues);

        $this->forgetCache();

        return $cart;
    }

    public function quantity(CartItem $item, int $quantity = 1): void
    {
        $item->update([
            'quantity' => $quantity,
        ]);

        $this->forgetCache();
    }

    public function delete(CartItem $item): void
    {
        // todo make soft delete, realize recent deleted product card
        $item->delete();
        $this->forgetCache();
    }

    public function truncate(): void
    {
        $this->get()?->delete();
        $this->forgetCache();
    }

    public function get(): ?Cart
    {
        return Cache::remember($this->cacheKey(), now()->addHour(), function () {
            return Cart::query()
                ->with('cartItems')
                ->where('storage_id', $this->identityStorage->get())
                ->when(auth()->check(), fn(Builder $q) => $q->orWhere('user_id', auth()->id()))
                ->first() ?? false;
        }) ?: null;
    }

    public function cartItems(): Collection
    {
        return collect($this->get()?->cartItems());
    }

    public function count(): int
    {
        return $this->cartItems()
            ->sum(fn(CartItem $item) => $item->quantity);
    }

    public function amount(): Price
    {
        return Price::make(
            $this->cartItems()
                ->sum(fn(CartItem $item) => $item->amount())
        );
    }

    private function cacheKey(): string
    {
        return str('cart_' . $this->identityStorage->get())
            ->slug('_')
            ->value();
    }

    private function forgetCache(): void
    {
        cache()->forget($this->cacheKey());
    }

    private function stringedOptionValues(array $optionValues): string
    {
        sort($optionValues);

        return implode(';', $optionValues);
    }

    private function storedData(string $id): array
    {
        $data = ['storage_id' => $id];
        if (auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }

        return $data;
    }
}