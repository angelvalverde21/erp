<?php

namespace App\Http\Livewire\User\Sales\EditSale;

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

        return view('livewire.user.sales.edit-sale.card-carrier-details',compact('order'));
    }
}
