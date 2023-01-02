<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentMethod;
use Livewire\Component;

class ShowSummary extends Component
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
        return view('livewire.user.sales.edit-sale.show-summary',compact('order'));
    }
}
