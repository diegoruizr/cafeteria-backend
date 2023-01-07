<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indica si la cookie XSRF-TOKEN debe configurarse en la respuesta.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * Los URIs que deben excluirse de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
