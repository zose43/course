<?php

namespace Domain\Catalog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class CategoryQueryBuilder extends Builder
{
    public function homePage(): self
    {
        return $this->where('on_main_page', true)
            ->orderBy('sorting')
            ->limit(10);
    }
}