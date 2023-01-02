<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Order;
use Livewire\Component;



class CardCarrierDetails extends Component
{
    protected $listeners = ['render'=>'render'];
    
    public function mount(Order $order){
        $this->order = $order;
    }

    public function render()
    {
        $order = $this->order;
        // $this->delivery_methods = DeliveryMethod::orderBy('name','asc')->get();
        // $this->paymentMethods = PaymentMethod::orderBy('name','asc')->get();
        // $this->repartidores = User::repartidores();

        return view('livewire.manage.orders.edit-order.card-carrier-details',compact('order'));
    }
}