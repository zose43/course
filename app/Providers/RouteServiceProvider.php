<?php

namespace App\Providers;

use RuntimeException;
use Illuminate\Http\Request;
use App\Routing\AppRegistrar;
use App\Routing\AuthRegistrar;
use App\Routing\CartRegistrar;
use App\Routing\OrderRegistrar;
use App\Contracts\RouteRegistrar;
use App\Routing\CatalogRegistrar;
use App\Routing\ProductRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Contracts\Routing\Registrar;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use function response;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    protected array $registrars = [
        OrderRegistrar::class,
        CartRegistrar::class,
        AppRegistrar::Class,
        AuthRegistrar::class,
        CatalogRegistrar::class,
        ProductRegistrar::class,
    ];

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('auth', static function (Request $request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        RateLimiter::for('global', static fn(Request $request) => Limit::perMinute(500)
            ->by($request->user()?->id ?: $request->ip())
            ->response(fn(Request $request, array $headers) => response('Take it easy', Response::HTTP_TOO_MANY_REQUESTS, $headers)
            )
        );
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (!class_exists($registrar) || !is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(sprintf("Cannot map routes '%s', it isn't valid routes class", $registrar));
            }
            (new $registrar())->map($router);
        }
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (Registrar $router) {
            $this->mapRoutes($router, $this->registrars);
        });
    }
}
