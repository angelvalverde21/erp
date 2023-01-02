<?php

use App\Models\Color;
use App\Models\ColorSize;
use App\Models\DeliveryMethod;
use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentListMethod;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Support\Facades\Log;

function createVaucher(){
    
}

function helperTotalPagar(){
    
}

function stockColorSizeId($color_size_id){
    $stock = ColorSize::find($color_size_id);
    return $stock->quantity;
}

function quantity($product_id, $color_id=null, $size_id = null){
    
    $product = Product::find($product_id);


    if($color_id && $size_id){
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    }elseif($color_id){
        $quantity = $product->colors->find($color_id)->quantity;
    }else{
        $quantity = $product->quantity;
    }

    return $quantity;
}

function actualizarStock($itemId,$param){

    $item = Item::find($itemId);
    $quantity = $item->quantity;
    $color_size_id = $item->content->color_size_id;
    $color_size = ColorSize::find($color_size_id);

    if($param=="separar"){
        $color_size->quantity = $color_size->quantity - $quantity;
    }elseif ($param="devolver") {
        # code...
        $color_size->quantity = $color_size->quantity + $quantity;
    }

    $color_size->save();

}

function separarStockSize($order_id){

    $order = Order::find($order_id);

    foreach ($order->items as $item) {
        # code...
        $color_size_id = $item->content->color_size_id;

        Log::debug("Este es el color_size_id: ". $color_size_id);
        $quantity = $item->quantity;

        $color_size = ColorSize::find($color_size_id);

        $color_size->quantity = $color_size->quantity - $quantity;

        $color_size->save();
    }
}

function devolverStockSize(Order $order){

    foreach ($order->items as $item) {
        # code...
        $color_size_id = $item->content->color_size_id;
        $quantity = $item->quantity;

        $color_size = ColorSize::find($color_size_id);

        $color_size->quantity = $color_size->quantity + $quantity;

        $color_size->save();
    }

}

function repartidores(){
    return User::repartidores();
}

function paymentListMethods(){
        
    return PaymentListMethod::all();

}

function deliveryMethods(){

    return DeliveryMethod::all();

}