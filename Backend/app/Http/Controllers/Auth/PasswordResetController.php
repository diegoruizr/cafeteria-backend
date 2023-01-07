<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Http\Controllers\MailController;
class PasswordResetController extends Controller
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

    /**
     * Crear token restablecer contraseña
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json(['message' => 'We can\'t find a user with that e-mail address.'], 404);
        $passwordReset = PasswordReset::updateOrCreate(

            ['email' => $user->email],['email' => $user->email,'token' => str_random(60)]
        );
        if ($user && $passwordReset)
            $url = $request->route;
            $method = new MailController();
            $method->send($user,$url,2);
        return response()->json(['message' => 'We have e-mailed your password reset link!']);
    }

     /**
     * Crear token restablecer contraseña por cliente
     *
     * @param  [User] user
     * @return [string] message
     */

    public function firstCreate($user)
    {
        $user = User::where('email', $user->email)->first();
        if (!$user)
            return response()->json(['message' => 'We can\'t find a user with that e-mail address.'], 404);
        $passwordReset = PasswordReset::updateOrCreate(

            ['email' => $user->email],['email' => $user->email,'token' => str_random(60)]
        );
        if ($user && $passwordReset)
            $ruta = request()->header('Origin').'/#/login';
            $user->notify(new PasswordResetRequest($passwordReset->token,$ruta));

        return response()->json(['message' => 'We have e-mailed your password reset link!']);
    }
    /**
     * Encontrar token restablecer contraseña
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset)
            return response()->json(['message' => 'This password reset token is invalid.'], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast())
        {
            $passwordReset->delete();
            return response()->json(['message' => 'This password reset token is invalid.'], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Restablecer contraseña
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $method = new MailController();
        return $method->confirm($request);
    }
}
