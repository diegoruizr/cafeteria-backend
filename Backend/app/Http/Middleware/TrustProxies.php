<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * Los servidores proxy de confianza para esta aplicación.
     *
     * @var array
     */
    protected $proxies;

    /**
     * Los encabezados que se deben utilizar para detectar proxies.
     *
     * @var int
     */
    protected $headers =  Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_AWS_ELB;
}
