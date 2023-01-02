<?php

namespace App\Http\Livewire\User\Sales\EditSale\Addresses;

use App\Models\Address;
use App\Models\District;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ShowAddressAll extends Component
{

    protected $listeners = [
        'render'=>'render',
    ];

    public function mount(Order $order){
        
        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();

        $this->order = $order;

        $this->user_id = $this->order->buyer_id;

    }



    public function selectAddress(Address $address){
        
        Log::info('La orden que se quiere cambiar es: '.$this->order);
        Log::info('el valor del address_id que cambiaremos es: '.$address);

        $this->order->address_id = $address->id;
        $this->order->save();
        $this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emit('select_address');


        Log::info('La orden cambiada es: '.$this->order);
        //$order->addres_id = 
        
    }

    public function render()
    {

        $addresses = Address::where('user_id',$this->user_id)->orderBy('updated_at','desc')->get();

        return view('livewire.user.sales.edit-sale.addresses.show-address-all',compact('addresses'));
    }

}
