<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\Order;
use Livewire\Component;

class CardShippingDetails extends Component
{

    protected $listeners = ['render'=>'render'];

    public function mount(Order $order){
        $this->order = $order;
    }
    public function render()
    {
        $order = $this->order;

        return view('livewire.user.sales.edit-sale.card-shipping-details',compact('order'));
    }
}
