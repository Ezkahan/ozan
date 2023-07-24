<?php

namespace Webkul\API\Providers;

use Illuminate\Support\ServiceProvider;
use Webkul\API\Http\Middleware\Version;
use Illuminate\Routing\Router;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        $router->aliasMiddleware('version', Version::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
