<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Livewire\Component;

class ModalCarrierDetails extends Component
{
    protected $listeners = ['render'=>'render'];

    protected $rules = [
        'order.delivery_man_id' => 'required',
        'order.payment_method_id' => 'required',
        'order.shipping_cost_carrier' => 'required',
        'order.shipping_cost_buyer' => 'required',
    ];

    public function mount(Order $order){
        $this->order = $order;
    }

    public function saveOrder(){
        $this->validate($this->rules);
        $this->order->save();
        $this->emit('actualizado');
        $this->emitTo('user.sales.edit-sale.card-carrier-details','render');
        $this->emitTo('user.sales.edit-sale.show-summary','render');
    }

    public function render()
    {
        $order = $this->order;
        $this->paymentMethods = PaymentMethod::orderBy('name','asc')->get();
        $this->repartidores = User::repartidores();


        return view('livewire.user.sales.edit-sale.modal-carrier-details',compact('order'));
    }
}
