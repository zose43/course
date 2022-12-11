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
        $category = $view->getData()['category'];
        $sort = Sort::make()
            ->add(new SortDefault($category, label: 'умолчанию'))
            ->add(new SortPriceAscent('price', 'от дешевых к дорогим', $category))
            ->add(new SortPriceDescent('-price', 'от дорогих к дешевым', $category))
            ->add(new SortAlphabet('title', 'наименованию', $category));

        $view->with('sort', $sort);
    }
}