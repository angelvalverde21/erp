<?php

use App\Models\AlbumLocation;
use App\Models\CollectMethod;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\DeliveryMethod;
use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentListMethod;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

function createVaucher()
{
}

function helperTotalPagar()
{
}

function uploadImage($request, $dir = "")
{

    // Log::info('up-1');

    $originalName = $request->file('file')->getClientOriginalName();
    // Log::info('up-2');
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    // Log::info('up-3');
    $nameEncrypt = md5(
        bcrypt(
            $originalName . bcrypt(time())
        )
    );
    
    // Log::info('up-4');
    $guardarEn = storage_path(). "/app/public/" .$dir . "/" . $nameEncrypt . "." . $extension;
    $returnName = $dir . "/" . $nameEncrypt . "." . $extension;
    Log::info($guardarEn);
    
    // Log::info('up-5');

    Image::make($request->file('file'))
        ->resize(750, null, function($constraint) {
            $constraint->aspectRatio();
        })
        ->save($guardarEn);

    // Log::info('up-6');

    return $returnName;
}

function stockColorSizeId($color_size_id)
{
    $stock = ColorSize::find($color_size_id);
    return $stock->quantity;
}

function getStockColorSize($color_size_id){
    $colorSize = ColorSize::find($color_size_id);
    return $colorSize->stocks();
}

function quantity($product_id, $color_id = null, $size_id = null)
{

    $product = Product::find($product_id);


    if ($color_id && $size_id) {
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    } elseif ($color_id) {
        $quantity = $product->colors->find($color_id)->quantity;
    } else {
        $quantity = $product->quantity;
    }

    return $quantity;
}

function actualizarStock($itemId, $param)
{

    $item = Item::find($itemId);
    $quantity = $item->quantity;
    $color_size_id = $item->content->color_size_id;
    $color_size = ColorSize::find($color_size_id);

    if ($param == "separar") {
        $color_size->quantity = $color_size->quantity - $quantity;
    } elseif ($param = "devolver") {
        # code...
        $color_size->quantity = $color_size->quantity + $quantity;
    }

    $color_size->save();
}

function separarStockSize($order_id)
{

    $order = Order::find($order_id);

    foreach ($order->items as $item) {
        # code...
        $color_size_id = $item->content->color_size_id;

        Log::debug("Este es el color_size_id: " . $color_size_id);
        $quantity = $item->quantity;

        $color_size = ColorSize::find($color_size_id);

        $color_size->quantity = $color_size->quantity - $quantity;

        $color_size->save();
    }
}

function devolverStockSize(Order $order)
{

    foreach ($order->items as $item) {
        # code...
        $color_size_id = $item->content->color_size_id;
        $quantity = $item->quantity;

        $color_size = ColorSize::find($color_size_id);

        $color_size->quantity = $color_size->quantity + $quantity;

        $color_size->save();
    }
}

//funciones para la migracion de la base de datos antigua

function filterDni($value){
    return preg_replace('/[^0-8]/', '', $value);
}

function filterCelular($value){
    return preg_replace('/[^0-9]/', '', $value);
}


function corregirDni($value){


    if ($value == "" ||$value == 0 ) {
        return NULL;
    }else{
        $filter = filterDni($value);

        if(strlen($filter)>0){
            return filterDni($value);
        }else{
            return NULL;
        }

    }

    
}

function corregirPhone($value){
    if ($value == "" || $value == 0 ) {
        return NULL;
    }else{
        $filter = filterCelular($value);

        if(strlen($filter)>0){
            return filterCelular($value);
        }else{
            return NULL;
        }
    }
}


function corregirDistrict($value){
    
    if ($value == "" || $value == 0 ) {
        return 150101;
    }else{
        return $value;
    }
}

function corregirEmail($value){
    if ($value == "") {
        return NULL;
    }else{
        return $value;
    }
}


function corregirPrecio($value){
    if ($value == "GRATIS" || $value == "" || $value == 0) {
        return null;
    }else{
        return $value;
    }
}

function corregirFecha($value){
    
    if ($value == "0000-00-00 00:00:00") {
        return "2010-00-00 00:00:00";
    }else{
        return $value;
    }
}

function getJson($path, $param = false){

    $json = json_decode(File::get($path), $param);
    
    if($param){
        foreach ($json as $fila) {
            # code...
            if($fila['type']=="table"){
                //aqui esta la data
                return $fila['data'];
            }
        }
    }else{
        foreach ($json as $fila) {
            # code...
            if($fila->type=="table"){
                //aqui esta la data
                return $fila->data;
            }
        }
    }

}

function extraerImagenOld($path){
    $name = explode('/',$path);
    // /storage/colors/7ecba4_polos-blanco-bividi-estampado-diseno-i-love-band-boys.jpg
    return $name[1];
}

function extraerJsonData($json, $param = false){

    $json = json_decode($json, $param);
    
    if($param){
        foreach ($json as $fila) {
            # code...
            if($fila['type']=="table"){
                //aqui esta la data
                return $fila['data'];
            }
        }
    }else{
        foreach ($json as $fila) {
            # code...
            if($fila->type=="table"){
                //aqui esta la data
                return $fila->data;
            }
        }
    }


}

function repartidores()
{
    return User::repartidores();
}

function paymentListMethods()
{

    return PaymentListMethod::all();
}

function deliveryMethods() // 01
{
    // Como se entregara el paquete: mediante delivery o recojo en almacen
    return DeliveryMethod::all();
}

function collectMethods() // 02
{
    //Como se pagar el cliente: efectivo, tarjeta, etc
    return CollectMethod::all();
}

function paymentMethods() // 03
{
    //Como se pagar el cliente: efectivo, tarjeta, etc
    return PaymentMethod::whereNull('payment_method_id')->get();
}

function calcularStockInicial($color_id, $size_id){
    
    $color_size = ColorSize::where('color_id',$color_id)->where('size_id', $size_id)->first();

    return $color_size->stocksBruto()->get()->count();

}

function albumLocation($album_id, $location_id){

    $album_location = AlbumLocation::where('album_id',$album_id)->where('location_id', $location_id)->first();

    return $album_location;
}

function createItemsOrder($items, $order_id){

    // $items = $items->toArray();

    Log::info('imprimiendo datos del carrito de compras');
    Log::info($items);

    if ($items) {

        Log::info('imprimiendo todo el objeto');

        Log::info($items);

        $i = 0;

        //recorremos cada item del itemCart

        foreach ($items as $item) {

            //calculamos cuantos elementos repetidos hay
            for ($j = 0; $j < $item['quantity']; $j++) {
                # code...
                $array_repetidos[] = $item['product_id'];
            }

            $i++;
        }

        Log::info('Products ids');

        Log::info($array_repetidos);


        $repetidos = array_count_values($array_repetidos);

        Log::info('Product_id con el total de repeticiones');

        Log::info($repetidos);


        // foreach ($repetidos as $product_id) {
        //     # code...
        // }

        $array_prices = [];

        foreach ($repetidos as $product_id => $cantidad) {

            // Log::info('Imprimiendo el product_id');

            // Log::info($product_id);

            // Log::info('Imprimiendo la cantidad');

            // Log::info($cantidad);

            # code...
            $product = Product::find($product_id);

            // Log::info('Imprimiendo el producto');
            // Log::info($product);

            $precios = $product->prices;

            // Log::info('Imprimiendo los precios');
            // Log::info($precios);

            foreach ($precios as $precio) {

                Log::info('ingreso al foreach');
                Log::info($precio['quantity']);

                if ($cantidad == $precio['quantity']) {
                    # code...
                    $array_prices[$product_id] = $precio['value'];
                    break;
                } else {
                    $array_prices[$product_id] = $product->price;
                }
            }
        }

        // Log::info('Array Precios');

        // Log::info($array_prices);

        foreach ($items as $item) {

            $product = Product::find($item['product_id']);

            //ojo $item->color_size_id no funciona en el foreach
            //se tiene que usar $item['color_size_id']

            // Log::info('imprimiendo el item del obejto');

            // Log::info($item);

            // Log::info('imprimiendo el id');

            // Log::info($item['color_size_id']);

            // Log::info('imprimiendo el qty');

            // Log::info($item->qty);

            try {
                # code...
                //Recibiendo los parametros del formulario uno por uno

                //fin de recibiendo los parametros del formulario

                switch ($item['type']) {
                    case 'color_id':
                        # code...
                        break;

                    case 'size_id':
                        # code...
                        break;

                    case 'none':
                        # code...
                        break;

                    default:

                        //color_size

                        //Buscando el color_size_id

                        // $tallaSolicitada = $item["talla"];

                        // switch ($product->how_sell) {
                        //     case 'value':
                        //         # code...
                        //         break;

                        //     default:
                        //         # code...
                        //         break;
                        // }

                        //Obtener el colorSize

                        //Obtencion del size_id apartir del nombre
                        $price_oferta = $array_prices[$item['product_id']];

                        $size = Size::where('product_id', $item['product_id'])->where('name',$item['talla'])->first();

                        $content = [
                            'product_id' => $item['product_id'], //es el id del item que se agrega ra a la orden, este contiene el color y talla
                            'quantity' => $item['quantity'], //es el id del item que se agrega ra a la orden, este contiene el color y talla
                            'color_id' => $item['color_id'], //es el id del item que se agrega ra a la orden, este contiene el color y talla
                            'talla_impresa' => $item['talla'], //name indica la talla
                            'id' => null,
                            'image' => $item['image'], //image indica la url de la imagen del colors
                            'price' => $price_oferta, //Este sera el precio real que se le cobrara al cliente, por eso que se pone en el json
                            // Asi lo podremos variarar sin malograr la base de datos
                        ];

                        if ($size) {

                            $colorSize = ColorSize::where('color_id', $item['color_id'])->where('size_id', $size->id)->first();

                            // $colorSize = ColorSize::find($item['id']);

                            if($colorSize){
                                $content['id'] = $colorSize->id;
                            }

                            //$item->asignar_stock(); //Asignar quiere decir que descuente de la base de datos el pedido porque este es seguro para entrega

                        } 

                        //Precio oferta
                        //$price_oferta = $array_prices[$colorSize->color->product->id];
                        
                        //Prapando el json content

                        //Renombrando la variable
                        $newItem = new Item();

                        $newItem->quantity = $item['quantity'];

                        $newItem->price = $product->price;
                        $newItem->description = $product->name;
                        $newItem->content = $content;
                        $newItem->order_id = $order_id;

                        $newItem->saveOrFail();

                        break;
                }
            } catch (\Exception $error) {
                return response()->json(
                    $data = [
                        "error" => "500",
                        "msg" => "Error al insertar los items de la orden",
                        "message_api" => $error->getMessage(),
                    ],
                    // $status = 500
                );
            }
        }
    }
}