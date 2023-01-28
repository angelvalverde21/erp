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
    public function comprobantesEmpaque($nickname, Order $order, Request $request){
        try {

            $request->validate([
                'file' => 'required|image|max:10240'  //10 megas
            ]);

            Log::info('se paso la validacion');
            Log::info($request);
            $image = Storage::put('orders/comprobantes/empaque', $request->file('file'));

            $order->comprobantesEmpaque()->create([ //crea un nuevo registro en la tabla images
                'usage' => 'comprobante_empaque',
                'name' => $image,
            ]);

        } catch (\Throwable $th) {

            Log::info('No se paso la validacion');
            // Log::info($th);
            Log::info($request);
        }

    }

    public function comprobantesEnvio($nickname, Order $order, Request $request){
        try {

            $request->validate([
                'file' => 'required|image|max:10240'  //10 megas
            ]);

            Log::info('se paso la validacion');
            Log::info($request);
            $image = Storage::put('orders/comprobantes/empaque', $request->file('file'));

            $order->comprobantesEmpaque()->create([ //crea un nuevo registro en la tabla images
                'usage' => 'comprobante_envio',
                'name' => $image,
            ]);

            Log::info('empieza el helper');
            Log::info(uploadImage($request));
            Log::info('Termina el helper');

        } catch (\Throwable $th) {

            Log::info('No se paso la validacion');
            // Log::info($th);
            Log::info($request);
        }
    }

    public function uploadFileOrderInvoice($nickname, Order $order, Request $request)
    {

        try {
            $request->validate([
                'file' => 'required|image|max:10240'  //10 megas
            ]);

            Log::info('se paso la validacion');
            Log::info($request);
            
            $image = uploadImage($request,"orders/comprobantes/payments");

            $order->payments()->create([
                'image' => $image,
                'payment_status_id' => "4",
                'amount' => $request->total_amount,
                'payment_method_id' => $request->payment_method_id,
                'content' => ["ejemplo" => "otro ejemplo"]
            ]);


            // Log::info('empieza el helper');
            // Log::info(uploadImage($request));
            // Log::info('Termina el helper');


        } catch (\Throwable $th) {

            Log::info('No se paso la validacion');
            // Log::info($th);
            Log::info($request);
        }




        // Log::info($request->file);
        // Log::info($request->amount);

        // Log::info('imprimiendo solo el precio');

        // Log::info($request->total_amount);
        // Log::info($request['total_amount']);

        // Log::info('imprimiendo solo el archivo');
        // Log::info($request->file('file'));
        // $request->validate([
        //     'file' => 'required|image|max:10240'  //10 megas
        // ]);

        // $image = Storage::put('orders', $request->file('file'));

        // $order->payments()->create([
        //     'image'=> $image,
        //     'status' => "PAID",
        //     'amount' => $request->total_amount,
        //     'content' => ["ejemplo"=>"otro ejemplo"]
        // ]);


        // $order->payments()->create([
        //     'image' => $image,
        //     'content' => ["ejemplo"=>"otro ejemplo"]
        // ]);

    }

    public function uploadImageOrder($nickname, Order $order, $field, Request $request) //ojo $field viene en el url del manage
    {
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('orders', $request->file('file'));
        $order[$field] = $url;
        $order->save();

        switch ($field) {

            case 'photo_payment':

                Log::info($url);

                $order->payments()->create([
                    'image' => $url,
                    'content' => ["ejemplo" => "otro ejemplo"]
                ]);

                //ojo content debe ser un array que contenta los detalles del pago

                $order->Addstatus('pago_confirmado', $request->current);

                break;
            case 'photo_package':
                # code...
                $order->Addstatus('listo_para_envio', $request->current);

                break;
            case 'photo_delivery':
                # code...
                $order->Addstatus('entregado', $request->current);
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
