<?php

namespace App\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface DTO
{
    public static function fromRequest(FormRequest $request): self;

    public function getProperties(): array;
}