<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','parent','accion','description','view','route','is_group','code','state','created_by','updated_by'];


    //METODOS


     /**
     * Permisos que pertenecen al perfil.
     */
    public function parent()
    {
        return $this->belongsTo('Post', 'parent');
    }

    public function children()
    {
        return $this->hasMany('Post', 'parent');
    }

    public function profiles()
    {
        return $this->belongsToMany('\App\Profile','permission_profiles')->withPivot('profile_id','state')->withTimestamps();
    }


}
