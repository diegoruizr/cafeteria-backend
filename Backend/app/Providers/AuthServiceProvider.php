<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Carbon\Carbon;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeos de política para la aplicación.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registrar cualquier servicio de autenticación / autorización.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        //Passport::$RevokeOldTokens;
        //Passport::$PruneOldTokens;
        Passport::personalAccessTokensExpireIn(now()->addHours(12));
        Passport::refreshTokensExpireIn(now()->addHours(12));
    }
}
