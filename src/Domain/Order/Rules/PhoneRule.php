<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    public function __construct() {}

    public function passes($attribute, $value): bool {}

    public function message(): string
    {
        return 'The validation error message.';
    }
}