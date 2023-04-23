<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CardShowInvoice extends Component
{

    protected $listeners = [
        'refreshOrder' => 'refreshOrder',
        'render' => 'render',
    ];

    protected $rules = [
        'order.payment_method_id' => 'required',
    ];



    public $order;
    public $store;
    public $total_amount;

    public function mount($order){

        $this->order = $order;
        $this->store = Request::get('store');
        $this->total_amount = $this->order->total_amount;

    }

    public function refreshOrder(){
        $this->order = $this->order->fresh();
        
        // $this->emitUp('renderOrder');
    }

    public function saveSelected()
    {
        $this->order->save();
        $this->order = $this->order->fresh();

    }

    public function deletePayment( $id ){
        $payment = Payment::findOrFail($id);
        $payment->delete();
        $this->order = $this->order->fresh();
        $this->emit('render');
        $this->emit('eliminado');

    }


    public function render()
    {
        $order = $this->order;

        return view('livewire.manage.orders.edit-order.card-show-invoice', compact('order'));
    }
}
