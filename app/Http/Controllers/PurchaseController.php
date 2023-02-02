<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Contracts\Foundation\Application;

class PurchaseController extends Controller
{
    public function index(): Application|RedirectResponse|Redirector
    {
        return redirect(
            PaymentSystem::create()
                ->url()
        );
    }

    public function callback(): JsonResponse
    {
        return PaymentSystem::validate()
            ->response();
    }
}