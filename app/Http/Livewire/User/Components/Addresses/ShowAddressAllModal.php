<?php

namespace App\Http\Livewire\User\Components\Addresses;

use App\Models\Address;
use Livewire\Component;

class ShowAddressAllModal extends Component
{
    
    public function mount($user_id){
        
        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();

        $this->user_id = $user_id;

    }

    public function render()
    {
        return view('livewire.user.components.addresses.show-address-all-modal');
    }
}
