<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Worksome\RequestFactories\Concerns\HasFactory;

class ResetPasswordFormRequest extends FormRequest
{
    use HasFactory;

    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email:dns',
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }
}