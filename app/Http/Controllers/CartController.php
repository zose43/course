<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Domain\Cart\Models\CartItem;
use Domain\Product\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(): View
    {
        return view('cart.index');
    }

    public function add(Product $product): RedirectResponse
    {
        cart()->add(
            $product,
            request('quantity', 1),
            request('options', [])
        );
        flash()->info('Товар добавлен в корзину');

        return redirect()->intended(route('cart.index'));
    }

    public function quantity(CartItem $item): RedirectResponse
    {
        flash()->info('Кол-во товара изменено');

        return redirect()->intended(route('cart.index'));
    }

    public function delete(CartItem $item): RedirectResponse
    {
        flash()->info('Удалено из корзины');

        return redirect()->intended(route('cart.index'));
    }

    public function truncate(): RedirectResponse
    {
        flash()->info('Корзина очищена');

        return redirect()->intended(route('cart.index'));
    }
}