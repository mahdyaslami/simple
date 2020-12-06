<?php

namespace App\Routes;

class Router
{
    /**
     * Define your base urls here.
     * 
     * @param  \FastRoute\RouteCollector  $router
     * @return void
     */
    public function boot(\FastRoute\RouteCollector $router)
    {
        require_once base_path('routes/web.php');
    }
}
