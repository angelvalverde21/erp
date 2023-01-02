<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class CardComprobantes extends Component
{
    protected $listeners = [
        'render'=>'render',
        'refreshOrder' => 'refreshOrder',
        'deletePhotoOrder' => 'deletePhotoOrder'
    ];
    
    public function mount(Order $order){
        $this->order = $order;
    }

    public function refreshOrder(){
        $this->order = $this->order->fresh();
    }
    
    public function deletePhotoOrder(Order $order, $deleteFunction){
       
        $order[$deleteFunction] = null;
        $order->save();
        $this->order = $this->order->fresh();
        Log::debug($order);
        Log::debug($deleteFunction);
        Log::debug('holaxxx');

    }

    // public function deletePayment($value){
       
    //     Log::debug('dddd');
    //     Log::info($value);
 
    // }

    public function render()
    {
        $order = $this->order;

        return view('livewire.user.sales.edit-sale.card-comprobantes', compact('order'));
    }
}
