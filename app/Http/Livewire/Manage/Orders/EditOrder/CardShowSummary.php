<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;


use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentMethod;
use Livewire\Component;

class CardShowSummary extends Component
{

    protected $listeners = [
        'render' => 'render',
    ];

    public function mount(Order $order){

        $this->order = $order;

    }

    public function render()
    {
        $order = $this->order;
        $this->payment_methods = PaymentMethod::orderBy('name','asc')->get();
        return view('livewire.manage.orders.edit-order.card-show-summary',compact('order'));
    }
}


