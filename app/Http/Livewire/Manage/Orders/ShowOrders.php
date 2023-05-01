<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrders extends Component
{

    protected $listeners = ['render' => 'render'];
    public $search;

    public function mount(){
        $this->store = Request::get('store');
    }

    public function cancelOrder(Order $order){
        $order->cancel();
    }

    public function render()
    {
        if($this->search <> ""){

            // $orders = Order::where('store_id',$this->store->id)->where('name','LIKE','%'. $this->search .'%')->limit(25)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
        
            // $orders = Order::whereHas('address', function($query) {
            //     $query->where('name','LIKE','%'. $this->search .'%')
            //             ->orWhereHas('district', function($query){
            //                 $query->where('name','LIKE','%'. $this->search .'%');
            //             });
            // })->limit(25)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

            // Log::info($this->search);
            

            $orders = Order::search($this->search);

        }else{
            
            $orders = Order::where('store_id',$this->store->id)->limit(20)->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();
        
        }


       // $orders = Order::where('store_id',$this->store->id)->where('is_active','=','0')->orderBy('id','desc')->with(['buyer','seller','delivery_man'])->get();

        // $orders2 = Order::whereHas('status', function ($query) {
        //     $query->where('status.id', '=', 5);
        // })->get();

        return view('livewire.manage.orders.show-orders',compact('orders'))->layout('layouts.manage');
    }


}
