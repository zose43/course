<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Domain\Order\Rules\PhoneRule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class OrderFormRequest extends FormRequest
{
    // todo add localization for messages
    public function rules(): array
    {
        /** email:dns --> check domain */
        return [
            'customer.first_name' => ['required'],
            'customer.last_name' => ['required'],
            'customer.email' => ['required', 'email:dns'],
            'customer.phone' => ['required', new PhoneRule()],
            'customer.address' => $this->checkDeliveryAddresses(),
            'customer.city' => $this->checkDeliveryAddresses(),
            'create_account' => ['bool'],
            'password' => Rule::when($this->boolean('create_account'),
                ['required', 'confirmed', Password::defaults()],
                ['sometimes']),
            'delivery' => ['required', 'exists:delivery_types,id'],
            'payment' => ['required', 'exists:payment_methods,id'],
        ];
    }

    protected function checkDeliveryAddresses(): RequiredIf
    {
        /** don't change id, it is a delivery point */
        return Rule::requiredIf(fn() => $this->get('delivery') !== '1');
    }

    public function authorize(): bool
    {
        return true;
    }
}