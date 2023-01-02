<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
    //

    public function uploadFileOrder(Order $order, $field, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        $url = Storage::put('public/orders', $request->file('file'));
        $order[$field] = $url;
        $order->save();
        //Log::debug($url);
        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }



    public function photoPayment(Order $order, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        $url = Storage::put('public/orders', $request->file('file'));
        $order->photo_payment = $url;
        $order->save();

        //Log::debug($url);
        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    public function photoPackage(Order $order, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        $url = Storage::put('public/orders', $request->file('file'));
        $order->photo_package = $url;
        $order->save();

        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    
    public function photoDelivery(Order $order, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        $url = Storage::put('public/orders', $request->file('file'));
        $order->photo_delivery = $url;
        $order->save();

        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }
}
