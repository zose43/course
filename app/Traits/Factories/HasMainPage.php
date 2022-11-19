<?php

namespace App\Traits\Factories;

trait HasMainPage
{
    public function onMainPage(): self
    {
        return $this->state(function ($attributes) {
            return [
                'on_main_page' => true,
            ];
        });
    }
}