<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Carbon\Carbon;

class VerifyState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new User();
        $user = $user->where('id',$request->header()['user'][0])->first();
        
        $tmp = \DB::table('oauth_access_tokens')->where('user_id', $user->id)->orderBy('created_at','DESC')->first();
        $var1 = Carbon::now();
        $var2 = $tmp->updated_at;
        $diff = $var1->diffInMinutes($var2);
        
        if($diff <= 30){
            \DB::table('oauth_access_tokens')->where('id', $tmp->id)->update([
            
                'updated_at'      => Carbon::now()->addMinutes(30),
            ]);
        } else {
            \DB::table('oauth_access_tokens')->where('id', $tmp->id)->update([
            
                'revoked'      => true,
            ]);
            return redirect('/home');
        }
        if($user->state==0){
            return redirect('/home');
        }
        return $next($request);
    }
}
