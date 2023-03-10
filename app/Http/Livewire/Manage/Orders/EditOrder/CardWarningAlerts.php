<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Order;
use Livewire\Component;


class CardWarningAlerts extends Component
{

    protected $listeners = ['render'=>'render'];

    public function mount(Order $order){
        $this->order = $order;
    }

    public function render()
    {
        $order = $this->order;

        return view('livewire.manage.orders.edit-order.card-warning-alerts',compact('order'));
    }

 
}
