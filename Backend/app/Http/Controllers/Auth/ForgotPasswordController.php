<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Restablecer contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar los correos electrónicos de
    | restablecimiento de contraseña e incluye un rasgo que ayuda a enviar
    | estas notificaciones desde su aplicación a sus usuarios.
    */

    use SendsPasswordResetEmails;

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
