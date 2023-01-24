<?php

namespace App\Http\Controllers\api\v1\store;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

require base_path('/vendor/autoload.php');

class PayController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api')->except(['example']);
    }

    public function tokenIzipay($nickname, Request $request)
    {

        // $data = [
        //     'amount' => 14995,
        //     'currency' => 'PEN',
        //     'orderId' => '125',
        //     'customer' => [
        //         'reference' => '963',
        //         'email' => 'test@gmail.com',
        //         'billingDetails' => [
        //             'firstName' => 'Juan perez'
        //         ]
        //     ],
        // ];

        $autorization = base64_encode("54188994:testpassword_CzNPhqrFHGCaEgmoywi6fshMi6HuezmTZfzxakRKAcLSJ");
        
        $headers = [
            'Authorization' => 'Basic ' . $autorization,
            'Accept' => 'application/json'
        ];

        $result =  Http::withHeaders($headers)->post("https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment", $request)->object();

        //devolviendo el token de izipay
        return $result->answer->formToken;
    }

    public function example(){
        //funcion que no esta protegia

    }

    public function registrarPagoIzipay($nickname, Request $request){

        $data = [
            "status_order" => "PAGADO",
        ];

        Log::info($request->clientAnswer['orderStatus']);

        // $order = Order::findOrFail($request->order_id);

        // $order->payments()->create([
        //     'payment_status_id' => 4, // el estatus 4 es 'paid'
        //     'amount' => 19.95,
        //     'payment_method_id' => 3,
        //     'content' => $request->data->clientAnswer->transactions[0]->transactionDetails->cardDetails->effectiveBrand

            
        // ]);

        // $orderStatus = $request->data['clientAnswer']['orderStatus'];

        // Log::info($request->order_id);
        // Log::info($request->data['clientAnswer']['transactions'][0]['transactionDetails']['cardDetails']);
        //Log::info($request->data->clientAnswer->transactions[0]->transactionDetails->cardDetails->effectiveBrand);
        

        return $data;

    }


    // public function generatePreferenceId()
    // {
    //     \MercadoPago\SDK::setAccessToken('PROD_ACCESS_TOKEN');

    //     $preference = new \MercadoPago\Preference();

    //     // Crea un ítem en la preferencia
    //     $item = new \MercadoPago\Item();
    //     $item->title = 'Mi producto';
    //     $item->quantity = 1;
    //     $item->unit_price = 75.56;
    //     $preference->items = array($item);
    //     $preference->save();
    // }
}


