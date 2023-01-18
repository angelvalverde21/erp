<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;

use App\Models\Image;
use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CardComprobantesEmpaque extends Component
{
    
    protected $rules = [
        'order.payment_method_id' => 'required',
    ];

    protected $listeners = [
        'refreshOrder' => 'refreshOrder',
    ];

    public $order;
    public $store;
    public $total_amount;

    public function mount(Order $order){

        $this->order = $order;
        $this->store = Request::get('store');
        $this->total_amount = $this->order->total_mount;

    }
    public function refreshOrder(){
        $this->emitTo('manage.orders.edit-order.card-status-iconos','render');
        $this->order = $this->order->fresh();
    }

    public function deleteComprobante( $id ){
        $comprobante = Image::findOrFail($id);
        $comprobante->delete();
        $this->order = $this->order->fresh();
        $this->emit('eliminado');
        $this->emitTo('manage.orders.edit-order.card-status-iconos','render');

    }

    public function render()
    {
        return view('livewire.manage.orders.edit-order.card-comprobantes-empaque');
    }
}
