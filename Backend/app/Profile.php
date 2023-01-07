<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','descripcion','level','code','state','created_by','updated_by'];


    //METODOS


    /**
     * Rol tiene muchas personas.
     */
    public function people()
    {
        return $this->hasMany('\App\Person');
    }

    /**
     * Roles que pertenecen al permiso.
     */
    public function permissions()
    {
        return $this->belongsToMany('\App\Permission','permission_profiles')->withPivot('permission_id','state')->withTimestamps();
    }
}
