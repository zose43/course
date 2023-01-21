<?php

namespace App\Http\Requests;

use Domain\Order\Rules\PhoneRule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        /** email:dns --> check domain */
        return [
            'customer.first_name' => ['required'],
            'customer.last_name' => ['required'],
            'customer.email' => ['required', 'email:dns'],
            'customer.phone' => ['required', new PhoneRule()],
            'customer.address' => ['sometimes'],
            'customer.city' => ['sometimes'],
            'create_account' => ['bool'],
            'password' => request()?->boolean('create_account')
                ? ['required', 'confirmed', Password::defaults()]
                : ['sometimes'],
            'delivery' => ['required', 'exists:delivery_types,id'],
            'payment' => ['required', 'exists:payment:methods,id'],
        ];
        // todo in sometimes props add condition via callback
    }

    public function authorize(): bool
    {
        return true;
    }
}