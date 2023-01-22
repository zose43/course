<?php

namespace App\Http\Controllers;

use DomainException;
use Domain\Order\DTOs\NewOrderDTO;
use Illuminate\Http\RedirectResponse;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use App\Http\Requests\OrderFormRequest;
use Domain\Order\Actions\NewOrderAction;

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

    public function handle(OrderFormRequest $request, NewOrderAction $action): RedirectResponse
    {
        $dto = NewOrderDTO::fromRequest($request);
        $order = $action($dto);

        return redirect()
            ->route('home');
    }
}