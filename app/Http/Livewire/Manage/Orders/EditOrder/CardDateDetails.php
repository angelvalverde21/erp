<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;


use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CardDateDetails extends Component
{
    protected $listeners = ['render'=>'render'];
    public $order;

    public function mount($order){
        $this->order = $order;
    }

    public function render()
    {
        Log::info('date details');
        return view('livewire.manage.orders.edit-order.card-date-details');
    }
}
