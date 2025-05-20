<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Dans la propriété $middleware, ajouter:
    protected $middleware = [
        // Middlewares existants...
        \App\Http\Middleware\SecurityHeaders::class,
    ];

    // Dans la propriété $routeMiddleware, ajouter:
    protected $routeMiddleware = [
        // Middlewares existants...
        'validateReservation' => \App\Http\Middleware\ValidateReservation::class,
        'validateReservationOwner' => \App\Http\Middleware\ValidateReservationOwner::class,
    ];
}