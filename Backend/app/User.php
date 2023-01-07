<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $connection = 'mysql';

    protected $dates = ['deleted_at'];


    //METODOS


    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'state', 'active', 'activation_token'];

    /**
     * Atributos ocultos para las matrices.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token',
    ];

    /**
     * Atributos convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //RELACIONES
    public function companies()
    {
        return $this->belongsToMany('\App\Company','company_users')->withPivot('company_id','state')->withTimestamps();
    }
}
