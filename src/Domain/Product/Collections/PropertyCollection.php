<?php

namespace Domain\Product\Collections;

use Illuminate\Database\Eloquent\Collection;

class PropertyCollection extends Collection
{
    public function withTitle(): self|\Illuminate\Support\Collection
    {
        return $this->mapWithKeys(fn($p) => [$p->title => $p->pivot->value]);
    }
}