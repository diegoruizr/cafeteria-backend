<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Zone;
use App\CompanyZone;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
     /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['nit','name', 'state', 'telephone','address', 'create_identification', 'updated_by',
    'updated_at'];

    protected $appends = ['base'];


    //METODOS

    
    /**
     * Attributo Append Base
     */
    public function getBaseAttribute()
    {
        $encode = '';
        $base = new Company();
        $base = $base->select('route_photo')->where([['id', $this->id],['route_photo','<>',''],['route_photo','<>',null]])->first();

        if($base != null){
            if(file_exists(trim($base->route_photo))){
                $url = strlen(public_path()."/storage/companies/");
                $result= substr($base->route_photo, $url);
                $contents = Storage::disk('public')->get('/'.'companies/'.$result);
                $encode = base64_encode($contents);
            }
        }
        return $encode;
    }

     /**
     * Compañias que pertenecen al usuario.
     */
    public function users()
    {
        return $this->belongsToMany('\App\User','company_users')->withPivot('user_id')->withTimestamps();
    }
    
     /**
     * Compañias que pertenecen a un usuario.
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
