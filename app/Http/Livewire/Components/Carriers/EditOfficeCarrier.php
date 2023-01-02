<?php

namespace App\Http\Livewire\Components\Carriers;

use App\Models\Address;
use Livewire\Component;
use App\Traits\AddressTrait;
use Illuminate\Support\Facades\Log;

class EditOfficeCarrier extends Component
{
    use AddressTrait;

    public function mount(Address $address){
        //$this->address = $address;

        $this->address = $address;

        $this->SendToInput($this->address);
    }

    public function save()
    {

        $address = $this->address;

        Log::debug('Empezando la validacion');

        $this->validate($this->rules);

        //crear usuario

        //crear direccion de envio

        
        $address->title = trim($this->address['title']);
        $address->name = trim($this->address['name']);
        
        if ($this->address['dni'] == "") {
            $this->address['dni'] = null;
        } else {
            $address->dni = str_replace(' ', '', $this->address['dni']);
        }

        $address->phone = str_replace(' ', '', $this->address['phone']);
        $address->primary = trim($this->address['primary']);
        $address->secondary = trim($this->address['secondary']);
        $address->references = trim($this->address['references']);
        //$address->user_id = $carrier->id; //el usuario al cual le pertenece la direccion
        $address->district_id  = $this->address['district_id']; //el usuario al cual le pertenece la direccion

        $address->save();
        //Log::debug('Direccion de envio creado :'.$address);

        $this->emit('actualizado'); //SweetAlert2
        //$this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('components.carriers.show-carrier-all', 'render');  //Refresca el componente ShowAddressAll

    }

    public function render()
    {
        $districts = $this->showDistricts($this->namedistrict);

        return view('livewire.components.carriers.edit-office-carrier', compact('districts'));
    }
}
