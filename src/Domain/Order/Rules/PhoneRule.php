<?php

namespace Domain\Order\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    public function passes($attribute, mixed $value): bool
    {
        $number = preg_replace('/^(8|\+7)/', '', $value);

        return preg_match('/\d/', $number) && strlen($number) === 10;
    }

    public function message(): string
    {
        return 'Введите номер телефона';
    }
}