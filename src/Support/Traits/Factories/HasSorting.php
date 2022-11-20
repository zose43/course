<?php

namespace Support\Traits\Factories;

trait HasSorting
{
    public function sorting(int $level): self
    {
        return $this->state(function ($attributes) use (&$level) {
            return [
                'sorting' => $level,
            ];
        });
    }
}