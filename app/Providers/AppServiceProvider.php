<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        $router->aliasMiddleware('verified', Middleware\EnsureEmailIsVerified::class);
        $this->app['router']->aliasMiddleware('is_admin', Middleware\IsAdmin::class);
    }
}
