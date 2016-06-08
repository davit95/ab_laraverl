<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'ajax' => \App\Http\Middleware\AjaxMiddleware::class,
        'permission' => \App\Http\Middleware\PermissionMiddleware::class,
        'view' => \App\Http\Middleware\View::class,
        'superAdmin' => \App\Http\Middleware\SuperAdmin::class,
        'oauth' => \Api\Server\Http\Middleware\OAuthMiddleware::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'owner' => \App\Http\Middleware\Owner::class,
        'superAdminOrOwner' => \App\Http\Middleware\SuperAdminOrOwner::class,
        'superAdminOrCsr' => \App\Http\Middleware\SuperAdminOrCsr::class,
        'client_user' => \App\Http\Middleware\Client::class,
        'superAdminOrOwnerOrCsr' => \App\Http\Middleware\SuperAdminOrOwnerOrCsr::class
    ];
}
