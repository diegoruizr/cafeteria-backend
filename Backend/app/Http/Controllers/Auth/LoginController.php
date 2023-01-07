<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador iniciar sesion
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja la autenticación de los usuarios para la
    | aplicación y los redirige a la pantalla de inicio. El controlador utiliza
    | un rasgo para proporcionar convenientemente su funcionalidad a sus aplicaciones.
    */

    use AuthenticatesUsers;

    /**
     * Variable para redirigir a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia de controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
