<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Livewire\Component;

class ModalCarrierDetails extends Component
{
    protected $listeners = ['render'=>'render'];

    protected $rules = [
        // 'order.delivery_man_id' => 'required',
        // 'order.payment_list_method_id' => 'required',
        'order.shipping_cost_carrier' => 'required',
        'order.shipping_cost_buyer' => 'required',
        'order.shipping_cost_to_carrier' => '',
    ];

    public $order;

    public function mount($order){
        $this->order = $order;
    }

    public function saveOrder(){
        $this->validate($this->rules);
        $this->order->save();
        $this->emit('actualizado');
        $this->emitTo('manage.orders.edit-order.card-shipping-cost','render');
        $this->emitTo('manage.orders.edit-order.card-show-summary','render');
    }

    public function render()
    {
        $order = $this->order;
        // $this->paymentMethods = PaymentMethod::orderBy('name','asc')->get();

        return view('livewire.manage.orders.edit-order.modal-carrier-details',compact('order'));
    }
}


