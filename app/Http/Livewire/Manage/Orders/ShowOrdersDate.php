<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrdersDate extends Component
{

    public $store;
    public $date;
    public $search;
    
    protected $listeners = ['render' => 'render'];

    public function mount($date){
        $this->store = Request::get('store');
        $this->date = $date;
    }

    public function cancelOrder(Order $order){
        $order->cancel();
    }

    public function render()
    {

        if($this->search <> ""){
            $orders = Order::search($this->search);

        }else{
            $orders = Order::where('store_id',$this->store->id)->limit(50)->where('delivery_date',$this->date)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
       
        }

        return view('livewire.manage.orders.show-orders',compact('ordersToday'))->layout('layouts.manage');

    }

}
