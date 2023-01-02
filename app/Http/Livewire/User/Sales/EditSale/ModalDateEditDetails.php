<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\Order;
use Livewire\Component;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\User;

class ModalDateEditDetails extends Component
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
        $this->emitTo('user.sales.edit-sale.card-date-details','render');
        //$this->emitTo('user.sales.edit-sale.show-summary','render');
    }

    public function render()
    {
        $order = $this->order;
        $this->delivery_methods = DeliveryMethod::orderBy('name','asc')->get();
        $this->payment_methods = PaymentMethod::orderBy('name','asc')->get();

        return view('livewire.user.sales.edit-sale.modal-date-edit-details', compact('order'));
    }
}
