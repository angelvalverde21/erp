<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Order;
use Livewire\Component;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\User;

class ModalDateDetails extends Component
{

    protected $rules = [

        'order.delivery_date' => 'nullable|date',
        'order.observations_time' => 'required',
        'order.delivery_time_start' => 'required',
        'order.delivery_time_end' => 'required'
    ];

    public function mount(Order $order){

        $user = new User();
        $this->order = $order;
        $this->carriers = $user->carriers();
        $this->repartidores = $user->repartidores();

    }

    public function saveOrder(){

        $this->order->save();
        $this->emit('actualizado');
        $this->emitTo('manage.orders.edit-order.card-date-details','render');
        $this->emitTo('manage.orders.edit-order.card-warning-alerts','render');
        //$this->emitTo('user.sales.edit-sale.show-summary','render');
    }

    public function render()
    {
        $order = $this->order;
        $this->delivery_methods = DeliveryMethod::orderBy('name','asc')->get();
        $this->payment_methods = PaymentMethod::orderBy('name','asc')->get();

        return view('livewire.manage.orders.edit-order.modal-date-details', compact('order'));
    }
}

