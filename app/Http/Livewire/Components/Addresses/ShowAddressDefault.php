<?php

namespace App\Http\Livewire\Components\Addresses;

use App\Models\Address;
use App\Models\User;
use Livewire\Component;

class ShowAddressDefault extends Component
{
    protected $listeners = ['render'=>'render'];

    public function mount(User $user){
        
        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();

        $this->user = $user;

    }

    public function render()
    {
        $user = $this->user;

        return view('livewire.components.addresses.show-address-default',compact('user'));
    }
}


