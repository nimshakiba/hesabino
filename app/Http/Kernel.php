<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...
        ],

        'api' => [
            // ...
        ],
    ];

    protected $routeMiddleware = [
        // ...
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'tenant.db' => \App\Http\Middleware\SwitchTenantDatabase::class,
        'switchTenantDatabase' => \App\Http\Middleware\SwitchTenantDatabase::class,
    ];
}
