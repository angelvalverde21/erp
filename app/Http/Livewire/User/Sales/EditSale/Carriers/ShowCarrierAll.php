<?php

namespace App\Http\Livewire\User\Sales\EditSale\Carriers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowCarrierAll extends Component
{

    protected $listeners = ['render'=>'render'];
    
    public function mount(Order $order){
       
        $this->order = $order;
    }

    public function selectAddress(Address $address){
        
        Log::debug('showCarrierAll');

        Log::info($address);

        $this->order->carrier_address_id = $address->id;
        $this->order->save();
        $this->emitTo('user.sales.edit-sale.card-carrier-details','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emit('select_address');   
    }

    public function render()
    {
        $carriers = User::carriers();
        return view('livewire.user.sales.edit-sale.carriers.show-carrier-all',compact('carriers'));
    }

}
