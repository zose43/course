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
        return view('cart.index', [
            'items' => cart()->items()
        ]);
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
        cart()->quantity($item, request('quantity', 1));

        return redirect()->intended(route('cart.index'));
    }

    public function delete(CartItem $item): RedirectResponse
    {
        flash()->info('Удалено из корзины');
        cart()->delete($item);

        return redirect()->intended(route('cart.index'));
    }

    public function truncate(): RedirectResponse
    {
        flash()->info('Корзина очищена');
        cart()->truncate();

        return redirect()->intended(route('cart.index'));
    }
}