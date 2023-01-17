<?php

namespace App\Http\Controllers;

use DomainException;
use Illuminate\Http\RedirectResponse;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;

class OrderController extends Controller
{
    public function index()
    {
        $items = cart()->items();

        if ($items->isEmpty()) {
            throw new DomainException('Пустая корзина');
        }

        return view('order.index', [
            'items' => $items,
            'deliveries' => DeliveryType::query()->all(),
            'payments' => PaymentMethod::query()->all(),
        ]);
    }

    public function handle(): RedirectResponse
    {
        return redirect()
            ->route('home');
    }
}