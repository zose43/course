<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Category;
use App\ViewModels\CatalogViewModel;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        return (new CatalogViewModel($category))->view('catalog.index');
    }
}