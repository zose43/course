<?php

namespace App\Http\ViewComposers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use Illuminate\View\View;

class NavigationViewComposer
{
    public function compose(View $view): void
    {
        // TODO isActive in view menu
        $menu = Menu::make()
            ->add(MenuItem::make('Главная', route('home')))
            ->add(MenuItem::make('Каталог', route('catalog')));

        /** menu is a variable in view */
        $view->with('menu', $menu);
    }
}