<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Breadcrumbs\BreadCrumb;
use Illuminate\Support\Collection;
use App\Breadcrumbs\BreadCrumbItem;
use Domain\Catalog\Models\Category;

class BreadCrumbViewComposer
{
    private function getCategorySlug(): string
    {
        return str(request()?->path())
            ->match('/catalog\/?(.*?)($|\/|\?)/')
            ->value();
    }

    private function getCategory(Collection $collection): ?Category
    {
        $slug = $this->getCategorySlug();

        return $collection->filter(fn(Category $v) => $v->slug === $slug)
            ->first();
    }

    public function compose(View $view): View|Collection
    {
        // TODO fix category link
        $categories = $view->getData()['categories'];
        $category = $this->getCategory($categories);
        $breadcrumbs = BreadCrumb::make()
            ->add(BreadCrumbItem::make('Главная', route('home')))
            ->add(BreadCrumbItem::make('Каталог', route('catalog')))
            ->addIf($category !== null,
                BreadCrumbItem::make($category?->title ?? '', $category?->slug ?? ''));

        return $view->with('breadcrumbs', $breadcrumbs);
    }
}