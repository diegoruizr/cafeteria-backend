<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Este espacio de nombres se aplica a las rutas de su controlador.
     *
     * Además, se establece como el espacio de nombres raíz del generador de URL.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define los enlaces de su modelo de ruta, filtros de patrón, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Definir las rutas para la aplicación.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Definir las rutas "web" para la aplicación.
     *
     * Todas las rutas reciben estado de sesión, protección CSRF, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define las rutas "api" para la aplicación.
     *
     * Estas rutas son típicamente apátridas.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
