<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','state','created_by','updated_by'];

    
    //METODOS


    /**
     * Categoria tiene muchos Productos.
     */
    public function products()
    {
        return $this->hasMany('\App\Product');
    }
}
