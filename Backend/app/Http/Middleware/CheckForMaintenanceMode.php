<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * Los URIs que deben estar disponibles mientras el modo de mantenimiento está habilitado.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
