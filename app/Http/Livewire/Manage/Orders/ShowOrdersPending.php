<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrdersPending extends Component
{
    protected $listeners = ['render' => 'render'];

    public function mount(){
        $this->store = Request::get('store');
    }

    public function cancelOrder(Order $order){
        $order->cancel();
    }

    public function render()
    {

        $user = Auth::user();

        Log::info('pending');

        $orders = Order::where('store_id',$this->store->id)->doesntHave('comprobantesEnvio')->limit(20)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
        //$orders = Order::where('store_id',$this->store->id)->limit(20)->limit(20)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
        // $orders = Order::where('store_id',$this->store->id)->where('is_active','=','0')->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

        // $orders2 = Order::whereHas('status', function ($query) {
        //     $query->where('status.id', '=', 5);
        // })->get();

        return view('livewire.manage.orders.show-orders',compact('orders'))->layout('layouts.manage');
    }
}