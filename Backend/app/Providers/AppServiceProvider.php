<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Registrar cualquier servicio de aplicación.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Arrancar cualquier servicio de aplicación.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        //Passport::hashClientSecrets();
    }
}
