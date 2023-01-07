<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['profile_id','user_id','name','identification','state','created_by','updated_by'];

    protected $appends = ['profile_name'];


    //METODOS
    

    /**
     * Personas que pertenecen a un Perfil.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class,'profile_id');
    }

    /**
     * Nombre del Perfil.
     */
    public function getProfileNameAttribute()
    {
        return $this->profile()->first()->description;
    }
}
