<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Order;
use Livewire\Component;

class CardStatusIconos extends Component
{
    public $order;
    
    protected $listeners = [
        'render' => 'render',
    ];

    public function mount($order){

        $this->order = $order;

    }

    public function render()
    {
        $order = $this->order;

        return view('livewire.manage.orders.edit-order.card-status-iconos');
    }
}
