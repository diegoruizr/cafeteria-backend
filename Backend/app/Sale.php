<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['product_id','quantity','state','created_by','updated_by'];

     // Se agrega Append para nombre del producto
     protected $appends = ['product_name'];

    //METODOS

    /**
     * Ventas que pertenecen a una producto.
     */
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    
    /**
     * Append Nombre Producto.
     */
    public function getProductNameAttribute()
    {
        $product = new Product();
        $product= $product->select('name')->where('id',$this->product_id)->first();
        return $product->name;
    }

}
