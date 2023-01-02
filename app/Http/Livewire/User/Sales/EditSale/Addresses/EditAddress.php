<?php

namespace App\Http\Livewire\User\Sales\EditSale\Addresses;

use App\Models\Address;
use App\Models\District;
use App\Traits\AddressTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditAddress extends Component
{

    use AddressTrait;

    public $address, $namedistrict;

    function mount(Address $address){

        $this->address = $address; //este es el addres que vamos a editar
        
        $this->SendToInput($this->address);
        // $this->address['name'] = $address->name;
        // $this->address['phone'] = $address->phone;
        // $this->address['dni'] = $address->dni;
        // $this->address['references'] = $address->references;
        // $this->address['primary'] = $address->primary;
        // $this->address['secondary'] = $address->secondary;
        // $this->address['district_id'] = $address->district_id;
        // $this->address['user_id'] = $address->user_id; //se monta en la plantilla de blade por seguridad
        // $this->namedistrict = $address->district->name.' - '.$address->district->province->name.' - '.$address->district->province->department->name;
        //$this->address = $address->name;
    }



    function deleteAddress(Address $address){
        $address->delete();
        
        $this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('user.sales.edit-sale.addresses.show-address-all','render');  //Refresca el componente ShowAddressAll
        //$this->address = $address->fresh();
    }

    public function save(){

        //Primero validamos los datos
        $this->validate($this->rules);

        //Asignamos los valores del objeto que hemos recibido en el mount a la variable $address para que podamos hacer $address->save()
        $address = $this->address;

        //Cargamos los valores que vienen del template
        $address = $this->loadValuesTemplateForAddress($address);
        
        //Guardamos
        $address->save();
        
        $this->emit('actualizado');
        $this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('user.sales.edit-sale.addresses.show-address-all','render');  //Refresca el componente ShowAddressAll

        //Cerrando modal que contiene a todas las direcciones
        //$this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#show-all-address-modal']);
    }

    public function render()
    {

        $districts = $this->showDistricts($this->namedistrict);

        return view('livewire.user.sales.edit-sale.addresses.edit-address',compact('districts'));
    }

}
