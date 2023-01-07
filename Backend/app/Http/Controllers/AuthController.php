<?php

namespace App\Http\Controllers;

use App\User;
use App\Person;
use App\Profile;
use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Autentificacion
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar todos las funciones de
    | autentificacion para cada unusario.
    */

    /**
     * iniciar sesion
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [json] [tokenResult object, userLogin User, companies Array]
     * @return [string] message
     * @return [json] [tokenResult object, userLogin User, company_id Company]
     * @return [json] companies Array
     */
    public function login(Request $request)
    {
        try {
            $name = str_replace('`', 'D', $request->encrypt);
            $name = str_replace('^', 'd', $name);
            $name = str_replace('~', 'N', $name);
            $name = str_replace('+', 'n', $name);
            $name = str_replace('´', 'C', $name);
            $name = str_replace(']', 'c', $name);
            $name = str_replace('[', 'B', $name);
            $name = str_replace('.', 'b', $name);
            $name = str_replace(',', 'U', $name);
            $name = str_replace('°', 'u', $name);
            $name = str_replace('_', 'O', $name);
            $name = str_replace('-', 'o', $name);
            $name = str_replace('$', 'I', $name);
            $name = str_replace('¡', 'E', $name);
            $name = str_replace('#', 'e', $name);
            $name = str_replace('!', 'A', $name);
            $name = str_replace('?', 'a', $name);
            $name = str_replace('*', 'Z', $name);
            // se decodifica el json con utf-8
            $basejson = json_decode(utf8_encode(base64_decode($name)));
            // se crea el objeto que maneja todas las credenciales pero desencriptadas del algoritmo personalizado.
            $credentials['email']= strval($basejson->email);
            $credentials['password']= strval($basejson->password);
            $credentials['active'] = 1;
            $credentials['deleted_at'] = null;
            if (!Auth::attempt($credentials)) {
                return response()->json(['status'=>'401', 'mensaje' => 'No Autorizado'], 401);
            } elseif ($request->user()->state == 0) {
                return response()->json(['status'=>'404', 'mensaje' => 'No Activo'], 404);
            }
            $user = $request->user();
            
            $userLogin = User::where('id', $user->id)->first();
            //return response()->json(['status'=>'401', 'mensaje' => $userLogin]);
            $companies =  $userLogin->companies;
            $people = new Person();
            $profile2 = new Profile();
            if (count($companies) == 1) {
                $tokenResult = $user->createToken('Token Acceso Personal');
                
                $userLogin->token = $tokenResult->accessToken;
                $userLogin->save();
                
                $profile = $people->where('user_id', $userLogin->id)->first();
                $profile_name  = $profile2->where('id', $profile->profile_id)->where('state',1)->first();
                if($profile_name == '' || $profile_name == null){
                    return response()->json(['status'=>'401', 'mensaje' => 'No tiene perfil activo'], 401);
                }
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type'   => 'Bearer',
                    'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                    'user_id'      => $userLogin->id,
                    'profile_id' => $profile_name->id,
                    'profile_name' => $profile_name->name,
                    'companies'    => $companies
                ]);
            } else {
                return response()->json(['mensaje' => 'Error General']);
            }
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => 'Error ' . $th->getLine() . ' :' . $th->getMessage()]);
        }
    }

    /**
     * Cerrar sesion
     *
     * @param  [User] token
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
        'Successfully logged out']);
    }

    /**
     * Crear instancia de usuario
     *
     * @param  [User] request
     * @return [json] user
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
