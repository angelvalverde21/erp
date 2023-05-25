<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrdersToday extends Component
{

    public $store;
    public $search;
    
    protected $listeners = ['render' => 'render'];

    public function mount(){
        $this->store = Request::get('store');
    }

    public function cancelOrder(Order $order){
        $order->cancel();
    }

    public function render()
    {

        $ordersAll = Order::where('store_id', $this->store->id)->limit(15)->orderBy('id', 'desc')->with(['buyer', 'seller', 'delivery_man'])->get();

        $ordersToday = Order::where('store_id', $this->store->id)->limit(20)->where('delivery_date', date('Y-m-d'))->orderBy('id', 'desc')->with(['buyer', 'seller', 'delivery_man'])->get();

        $ordersPendientesPago = Order::where('store_id', $this->store->id)->doesntHave('payments')->doesntHave('comprobantesEnvio')->limit(20)->orderBy('id', 'desc')->with(['buyer', 'seller', 'delivery_man'])->get();

        $ordersPagados = Order::where('store_id', $this->store->id)->Has('payments')->limit(20)->orderBy('id', 'desc')->with(['buyer', 'seller', 'delivery_man'])->get();


        if($this->search <> ""){
            $ordersResult = Order::search($this->search);

        }else{
            $ordersResult = Order::where('store_id',$this->store->id)->limit(20)->where('delivery_date',date('Y-m-d'))->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
        }

        // $orders = Order::where('store_id',$this->store->id)->where('is_active','=','0')->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

        // $orders2 = Order::whereHas('status', function ($query) {
        //     $query->where('status.id', '=', 5);
        // })->get();

        return view('livewire.manage.orders.show-orders',compact('ordersAll', 'ordersToday', 'ordersPendientesPago', 'ordersPagados', 'ordersResult'))->layout('layouts.manage');

    }


}
