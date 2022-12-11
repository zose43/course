<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Domain\Catalog\Sorts\Sort;
use Domain\Catalog\Sorts\SortDefault;
use Domain\Catalog\Sorts\SortAlphabet;
use Domain\Catalog\Sorts\SortPriceAscent;
use Domain\Catalog\Sorts\SortPriceDescent;

class SortViewComposer
{
    public function compose(View $view): void
    {
        $sort = Sort::make()
            ->add(new SortDefault(label: 'умолчанию'))
            ->add(new SortPriceAscent('price', 'от дешевых к дорогим'))
            ->add(new SortPriceDescent('-price', 'от дорогих к дешевым'))
            ->add(new SortAlphabet('title', 'наименованию'));

        $view->with('sort', $sort);
    }
}