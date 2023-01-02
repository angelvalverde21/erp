<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrders extends Component
{

    protected $listeners = ['render' => 'render'];

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {
        $user = Auth::user();

        $orders = Order::where('store_id',$this->store->id)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

        return view('livewire.manage.orders.show-orders',compact('orders'))->layout('layouts.manage');
    }


}
