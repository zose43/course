<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Breadcrumbs\BreadCrumb;
use Illuminate\Support\Collection;
use App\Breadcrumbs\BreadCrumbItem;

class BreadCrumbViewComposer
{
    public function compose(View $view): View|Collection
    {
        $category = request()?->route()?->parameter('category');
        $breadcrumbs = BreadCrumb::make()
            ->add(BreadCrumbItem::make('Главная', route('home')))
            ->add(BreadCrumbItem::make('Каталог', route('catalog')))
            ->addIf($category !== null,
                BreadCrumbItem::make($category->slug ?? '', route('catalog', $category)));

        return $view->with('breadcrumbs', $breadcrumbs);
    }
}