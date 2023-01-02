<?php

namespace App\Http\Livewire\Components\Carriers;

use App\Traits\AddressTrait;
use Livewire\Component;
use App\Models\User;
use App\Models\Address;

class CreateOfficeCarrier extends Component
{
    use AddressTrait;

    public function mount($user_id){

        $this->user =  User::find($user_id);
        $this->SendToInput($this->user);
    }

    public function save(){

        $this->validate($this->rules);

        $address = new Address();

        $address = $this->loadValuesTemplateForAddress($address);

        $address->save();

        $this->emit('creado'); //SweetAlert2
        //$this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('user.sales.edit-sale.carriers.show-carrier-all','render');  //Refresca el componente ShowAddressAll
    }


    public function render()
    {
        $districts = $this->showDistricts($this->namedistrict);
        return view('livewire.components.carriers.create-office-carrier',compact('districts'));
    }
}


