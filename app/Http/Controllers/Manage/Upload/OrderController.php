<?php

namespace App\Http\Controllers\Manage\Upload;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\OrderStatus;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function uploadFileOrder($nickname, Order $order, $field, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        
        $url = Storage::put('orders', $request->file('file'));
        $order[$field] = $url;
        $order->save();

        switch ($field) {
            case 'photo_payment':

                $order->Addstatus('pago_confirmado',$request->current);
                
            break;
            case 'photo_package':
                # code...
                $order->Addstatus('listo_para_envio',$request->current);

                break;
            case 'photo_delivery':
                # code...
                $order->Addstatus('entregado',$request->current);
                break;
            
            default:
                # code...
                Log::info('default');
                break;
        }

        Log::debug('request');
        Log::info($request);

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
