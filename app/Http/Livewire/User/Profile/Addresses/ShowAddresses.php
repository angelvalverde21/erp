<?php

namespace App\Http\Livewire\User\Profile\Addresses;

use App\Models\User;
use Livewire\Component;
use App\Models\Address;

class ShowAddresses extends Component
{

    public $user;
    protected $listeners = ['refreshAddresses'=>'render'];
    
    function mount(User $user){
        $this->user = $user;
    }

    public function render()
    {

        $addresses = Address::with(['district.province.department'])->where('user_id',$this->user->id)->get();

        return view('livewire.user.profile.addresses.show-addresses', compact('addresses'));
    }
}
