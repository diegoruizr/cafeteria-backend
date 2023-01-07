<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['name','category_id','reference','price','weight','stock','state','created_by','updated_by'];

    // Se agrega Append para nombre de la categoria
    protected $appends = ['category_name'];


    //METODOS
    

     /**
     * Productos que pertenecen a una categoria.
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**
     * Producto tiene muchas ventas.
     */
    public function sales()
    {
        return $this->hasMany('\App\Sale');
    }

    /**
     * Append Nombre Categoria.
     */
    public function getCategoryNameAttribute()
    {
        $category = new Category();
        $category= $category->select('name')->where('id',$this->category_id)->first();
        return $category->name;
    }
}
