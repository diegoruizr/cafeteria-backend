<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador restablecer contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar las solicitudes de
    | restablecimiento de contraseña y utiliza un rasgo simple para incluir este
    | comportamiento.
    */

    use ResetsPasswords;

    /**
     * Variable que redirige a los usuarios después de restablecer su contraseña.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
