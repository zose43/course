<?php

namespace Domain\Product\Collections;

use Illuminate\Database\Eloquent\Collection;

class OptionValueCollection extends Collection
{
    public function keyValue(): \Illuminate\Support\Collection
    {
        return $this->mapToGroups(function ($item) {
            return [$item->option->title => $item];
        });
    }
}