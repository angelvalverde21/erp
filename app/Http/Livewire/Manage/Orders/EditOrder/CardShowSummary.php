<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;


use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CardShowSummary extends Component
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
        // $this->payment_methods = PaymentMethod::orderBy('name','asc')->get();
        Log::info('card show summary');
        return view('livewire.manage.orders.edit-order.card-show-summary',compact('order'));
    }
}


