<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador verificacion E-mail
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar la verificación de correo
    | electrónico para cualquier usuario que se haya registrado recientemente
    | con la aplicación. Los correos electrónicos también pueden reenviarse si
    | el usuario no recibió el mensaje de correo electrónico original.
    |
    */

    use VerifiesEmails;

    /**
     * Variable que redirige a los usuarios después de la verificación.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
