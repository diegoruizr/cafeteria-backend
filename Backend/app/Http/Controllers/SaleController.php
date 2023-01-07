<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Mostrar una lista de ventas por producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = new Product();
        $product = $product->where('id',$request->id)->first();

        $sales = $product->sales()->orderBy('id', 'ASC')->paginate(10);
        return response()->json([
            "sales" => $sales
        ]);
    }


    /**
     * Crear venta
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = new Product();
        $product = $product->where('id',$request->product_id)->first();
        $product->stock = intval($product->stock) - intval($request->sale['quantity']);
        $product->save();

        $validacion = true;
        $sale = new Sale();
        $sale->product()->associate($request->product_id);
        $sale->quantity = $request->sale['quantity'];
        $sale->state = 1;
        $sale->created_by = request()->header('user');
        $sale->created_at = Carbon::now();
        if(!$sale->save()){
            $validacion = false;
            App::abort(106, 'Error al crear la venta del producto');
        }
        if($validacion)
        {
            return response()->json([
                "message" => "venta del producto creado correctamente",
                "sale" => $sale,
                "stock" => $product->stock
            ],200);
        }
    }
}
