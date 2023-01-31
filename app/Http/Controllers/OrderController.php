<?php

namespace App\Http\Controllers;

use DomainException;
use Domain\Order\DTOs\NewOrderDTO;
use Illuminate\Http\RedirectResponse;
use Domain\Order\Models\DeliveryType;
use Domain\Order\DTOs\NewCustomerDTO;
use Domain\Order\Models\PaymentMethod;
use App\Http\Requests\OrderFormRequest;
use Domain\Order\Actions\NewOrderAction;
use Domain\Order\Processes\OrderProcess;
use Domain\Order\Processes\AssignCustomer;
use Domain\Order\Processes\AssignProducts;
use Domain\Order\Processes\ChangeStateToPending;
use Domain\Order\Processes\CheckProductQuantities;
use Domain\Order\Processes\DecreaseProductQuantity;

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
        $dtoCustomer = NewCustomerDTO::fromRequest($request);
        $dtoOrder = NewOrderDTO::fromRequest($request);
        $order = $action($dtoOrder);

        (new OrderProcess($order))->processes([
            new CheckProductQuantities(),
            new AssignCustomer($dtoCustomer),
            new AssignProducts(),
            new ChangeStateToPending(),
            new DecreaseProductQuantity()
        ])->dispatch();

        cart()->truncate();

        return redirect()
            ->route('home');
    }
}