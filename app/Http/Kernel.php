<?php

namespace portalLogia\Http;

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
        \Styde\Html\Alert\Middleware::class,
        \portalLogia\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \portalLogia\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \portalLogia\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \portalLogia\Http\Middleware\RedirectIfAuthenticated::class,

        //Middlewares Roles
        'is_Admin'      => \portalLogia\Http\Middleware\isAdmin::class,
        'is_Tesorero'   => \portalLogia\Http\Middleware\isTesorero::class,
        'is_Secretario' => \portalLogia\Http\Middleware\isSecretario::class,
        'is_Venerable'  => \portalLogia\Http\Middleware\isVenerable::class,
        'is_Maestro'    => \portalLogia\Http\Middleware\isMaestro::class,
        'is_Companero'  => \portalLogia\Http\Middleware\isCompanero::class,
        'is_Aprendiz'   => \portalLogia\Http\Middleware\isAprendiz::class,                
    ];
}
