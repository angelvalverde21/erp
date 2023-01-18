<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;


use App\Models\Order;
use Livewire\Component;

class CardDateDetails extends Component
{
    protected $listeners = ['render'=>'render'];

    public function mount(Order $order){
        $this->order = $order;
        
    }

    public function render()
    {
        $order = $this->order;

        return view('livewire.manage.orders.edit-order.card-date-details',compact('order'));
    }
}
