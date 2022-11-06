<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Worksome\RequestFactories\Concerns\HasFactory;

class SignUpFormRequest extends FormRequest
{
    use HasFactory;

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => str($this->request->get('email'))
                ->squish()/** ultra trim */
                ->lower()
                ->value()
            /** send str instead of object */
        ]);
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email:dns|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'name' => 'required|string|min:2',
        ];
    }
}