<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //

    public function createOrderWithUserId($nickname, User $user){

        $store = User::where('nickname', '=', $nickname)->limit(1)->first();

        $order = new Order();

        $order->delivery_man_id = 1707;
        $order->payment_method_id = 5; //yape
        $order->delivery_method_id = 1; //delivery
        $order->store_id = $store->id;
        $order->seller_id = Auth::user()->id; //el usuario autenticado en laravel
        $order->buyer_id = $user->id;
        
        $user->addresses;

        if($user->addresses->count()>0){

            foreach ($user->addresses as $address) {
                # code...
                $address_id = $address->id;
    
                break;
            }

            $order->address_id = $address_id; //el id de la direccion recien creada

            try {
    
                $order->saveOrFail();
                
                $order->Addstatus('creado');
    
                Log::debug('Orden creada :' . $order);
        
                $this->emitTo('manage.orders.show-orders', 'render');
        
                //este emit necesita un listener
                $this->emit('creado');
    
            } catch (\Throwable $th) {
                //throw $th;
                Log::info('error al crear la orden');
                Log::info($th);
            }



        }

        return redirect()->route('manage.orders.edit', ['nickname' => $store->nickname, 'order' => $order->id]);

    }
}
