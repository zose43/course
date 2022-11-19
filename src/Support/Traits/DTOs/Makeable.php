<?php

namespace Support\Traits\DTOs;

trait Makeable
{
    public static function make(mixed ...$arguments): static
    {
        return new self(...$arguments);
    }
}