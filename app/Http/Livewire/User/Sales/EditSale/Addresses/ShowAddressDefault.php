<?php

namespace App\Http\Livewire\User\Sales\EditSale\Addresses;

use App\Models\Address;
use App\Models\Order;
use Livewire\Component;

class ShowAddressDefault extends Component
{
    protected $listeners = ['render'=>'render'];

    public function mount(Order $order){
        
        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();

        $this->order = $order;

    }

    public function render()
    {
        
        $order = $this->order;

        return view('livewire.user.sales.edit-sale.addresses.show-address-default',compact('order'));
    }
}
