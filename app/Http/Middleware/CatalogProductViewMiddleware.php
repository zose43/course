<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CatalogProductViewMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        session()->put('product_view', session()->get('product_view', 'block'));
        if ($request->has('product_view')) {
            session()->put('product_view', $request->get('product_view'));
        }

        return $next($request);
    }
}