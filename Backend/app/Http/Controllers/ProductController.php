<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mostrar una lista de Productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = new Product();
        if ($request->name != '') {
            $products = $products
            ->where('products.name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->reference != '') {
            $products = $products
            ->where('products.reference', 'LIKE', '%'.$request->reference.'%');
        }
        $products = $products->orderBy('id', 'ASC')->paginate(10);
        return response()->json([
            "products" => $products
        ]);
    }

    
    /**
     * Detalle de las categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        $categories = new Category();
        $categories= $categories->orderBy('name', 'ASC')->get();
        return response()->json(['categories' => $categories]);
    }

    /**
     * Metodo que devuelve codigo para referencia unica.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uniqueReference(Request $request){
        $product = new Product();
        $product = $product->where('reference',$request->input('reference'))->first();
        if($product != null && $product != "" ){
            return response()->json([
                'status' => 501,
            ]);
        }else {
            return response()->json([
                'status' => 200,
           ]);
        }
    }


    /**
     * Crear Producto
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validacion = true;
        $product = new Product();
        $product->category()->associate($request->product['category_id']);
        $product->name = $request->product['name'];
        $product->reference = $request->product['reference'];
        $product->price = $request->product['price'];
        $product->weight = $request->product['weight'];
        $product->stock = $request->product['stock'];
        $product->state = 1;
        $product->created_by = request()->header('user');
        $product->created_at = Carbon::now();
        if(!$product->save()){
            $validacion = false;
            App::abort(106, 'Error al crear el producto');
        }
        if($validacion)
        {
            return response()->json([
                "message" => "producto creado correctamente",
                "product" => $product,
                "valid"   => 0
            ],200);
        }
    }

    /**
     * Mostrar un producto especifico
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        
        $product = new Product();
        $product = $product->where('id',$request->id)->first();

        $categories = new Category();
        $categories= $categories->orderBy('name', 'ASC')->get();

        return response()->json([
            'product' => $product,
            'categories' => $categories
        ]);
    }


    /**
     * Actualizar un Producto
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $product = new Product();
        $product = $product->where('id',$request->product['id'])->firstOrfail();
        
        $product->category()->associate($request->product['category_id']);
        $product->name = $request->product['name'];
        $product->reference = $request->product['reference'];
        $product->price = $request->product['price'];
        $product->weight = $request->product['weight'];
        $product->stock = $request->product['stock'];
        $product->state = 1;
        $product->updated_by = request()->header('user');
        $product->updated_at = Carbon::now();
        $product->save();

        return response()->json([
            'message' => 'Actualizacion correcta de producto',
            "valid"   => 0
        ]);
    }

    /**
     * Actualizar un estado de un Producto
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request)
    {
        $product = new Product();
        $product = $product->where('id', $request->id)->firstOrfail();
        $product->state = $request->new_state;
        $product->updated_by = request()->header('user');
        $product->updated_at = Carbon::now();
        $mensaje= "";
        if($product ->save()){
            $mensaje="Estado Cambiado Correctamente";
        }
        else{
            $mensaje="Error al Cambiar el Estado";
        }
        return response()->json(['message' => $mensaje]);
    }

    /**
     * Mostrar Assignaciones de tipos de habitacion
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRoomTypes(Request $request){
        
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->id)->first();

        $room_types = new RoomType();
        $room_types = $room_types->get();
        return response()->json([
            'room_types' => $room_types,
            'number_room' => $hotel->number_room,
            'name_hotel' => $hotel->name
        ]);
    }

    /**
     * Mostrar Acomodaciones
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAccommodations(Request $request){
        $array = array();
        $room_type = new RoomType();
        $room_type = $room_type->where('id',$request->id)->first();
        
        $pivot = $room_type->accommodations()->select('accommodation_room_types.id as id_pivot')->wherePivot('state', 1)->get();
        
        foreach ($pivot as $key) {
            $accommodation = new Accommodation();
            $accommodation= $accommodation->select('name')->where('id',$key['pivot']->accommodation_id)->first();
            array_push($array, [
                "pivot_id" => $key->pivot_id,
                "name" => $accommodation->name,
                "id" => $key['pivot']->accommodation_id
            ]);
        }
        return response()->json([
            'accommodations' => $array
        ]);
    }

    /**
     * Asignar habitaciones al Hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function assing(Request $request){
        $object = $request->object;

        $hotel = new Hotel();
        $hotel = $hotel->where('id',$object['hotel_id'])->first();
        $hotel->accomodationRoomTypes()->detach();
        foreach ($object['tableData'] as $key ) {

            $room_type = new RoomType();
            $room_type = $room_type->where('id',$key['room_type_id'])->first();
    
            $pivot_accommodation_room_type = $room_type->accommodations()->select('accommodation_room_types.id as id_pivot')->wherePivot('accommodation_room_types.accommodation_id', $key['accommodation_id'])->wherePivot('accommodation_room_types.state', 1)->first();

            //$result = $hotel->accomodationRoomTypes()->where('hotel_accommodation_room_types.hotel_id',$hotel->id)->updateExistingPivot($pivot_accommodation_room_type['id_pivot'],['state'=>1,'quantity'=>$key['quantity']]);
            
            //if($result == 0)
            //{
            $hotel->accomodationRoomTypes()->attach($pivot_accommodation_room_type['id_pivot'],['state'=>1,'quantity'=>$key['quantity']]);
            //}
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }


    /**
     * Mostrar Assignaciones de habitaciones para el hotel
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAssing(Request $request){
        $array = [];
        $count = 0;
        $hotel = new Hotel();
        $hotel = $hotel->where('id',$request->id)->first();

        $pivot = $hotel->accomodationRoomTypes()->select('hotel_accommodation_room_types.id as id_pivot')->wherePivot('hotel_accommodation_room_types.state', 1)->get();
        foreach ($pivot as $key) {
            $accommodarionRoomTypes = new AccommodationRoomType();
            $accommodarionRoomTypes = $accommodarionRoomTypes->where('id',$key['pivot']->accommodation_room_type_id)->first();
            
            $accommodation = new Accommodation();
            $accommodation= $accommodation->select('name')->where('id',$accommodarionRoomTypes['accommodation_id'])->first();

            $room_types = new RoomType();
            $room_types = $room_types->select('name')->where('id',$accommodarionRoomTypes['room_type_id'])->first();
            
            $temporal = array(
                "accommodation_id" => $accommodarionRoomTypes->accommodation_id,
                "accommodation_name" => $accommodation->name,
                "room_type_id" => $accommodarionRoomTypes->room_type_id,
                "room_type_name" => $room_types->name,
                "quantity" => $key['pivot']->quantity
            );
            $count = $count + $key['pivot']->quantity;
            array_push($array, $temporal);
        }
        return response()->json([
            'tableData' => $array,
            'total' => $count
        ]);
    }
}
