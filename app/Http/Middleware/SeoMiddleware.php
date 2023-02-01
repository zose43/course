<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $slug = str(request()?->getPathInfo())->slug('_');
        /** @var Seo $seo */
        $seo = Cache::tags('seo')
            ->rememberForever("seo_$slug", static function () use ($request) {
                return Seo::query()
                    ->where('url', $request->getPathInfo())
                    ->first() ?? false;
            });

        if ($seo) {
            view()->share('seo_title', $seo->title);
        }

        return $next($request);
    }
}