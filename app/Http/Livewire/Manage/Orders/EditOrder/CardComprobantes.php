<?php

namespace App\Http\Livewire\Manage\Orders\EditOrder;


use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;


class CardComprobantes extends Component
{
    protected $listeners = [
        'render'=>'render',
        'refreshOrder' => 'refreshOrder',
        'deletePhotoOrder' => 'deletePhotoOrder',
        'registrarCordenada' => 'registrarCordenada'
    ];

    public $order;
    public $store;
    
    public function mount(Order $order){
        $this->order = $order;
        $this->store = Request::get('store');
    }

    public function refreshOrder(){
        $this->order = $this->order->fresh();
    }
    
    public function registrarCordenada($value){
        //Log::info($value);
    }
    

    //Esta funcion viene de un emit
    public function deletePhotoOrder(Order $order, $deleteFunction){
       
        //ejemplo setea el campo "photo_payment" a null y luego guarda el cambio
        
        

        switch ($deleteFunction) {
            case 'photo_payment':
                $order->removeStatus('pago_confirmado');
                break;
            
            default:
                # code...
                break;
        }

        $order[$deleteFunction] = null;
        $order->save();
        
        $this->order = $this->order->fresh();

        
        //Log::debug($order);
        //Log::debug($deleteFunction);

    }

    // public function deletePayment($value){
       
    //     Log::debug('dddd');
    //     Log::info($value);
 
    // }

    public function render()
    {
        $order = $this->order;

        return view('livewire.manage.orders.edit-order.card-comprobantes', compact('order'));
    }
}

