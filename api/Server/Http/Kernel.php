<?php

namespace Api\Server\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{    
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Api\Server\Http\Middleware\OAuthMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'oauth' => \Api\Server\Http\Middleware\OAuthMiddleware::class,        
    ];
}
