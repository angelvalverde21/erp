<?php

namespace App\Http\Livewire\Components\Carriers;


use App\Traits\AddressTrait;
use Livewire\Component;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Log;

class CreateCarrier extends Component
{
    use AddressTrait;

    public function mount()
    {

        $this->user = new User();
        $this->SendToInput($this->user);
    }

    public function save()
    {

        Log::debug('Empezando la validacion');

        $this->validate($this->rules);

        //crear usuario

        $carrier = new User();
        $carrier->name = trim($this->address['name']); //Elimina los espacios en blanco al incio y final

        if ($carrier->dni=="") {
            $carrier->dni = null;
        }else{
            $carrier->dni = str_replace(' ', '', $this->address['dni']); //Elimina los espacios en blanco de toda la cadena
        }
        
        $carrier->phone = str_replace(' ', '', $this->address['phone']); //Elimina los espacios en blanco de toda la cadena
        $carrier->password = bcrypt(substr(trim($this->address['name']), 0, 1) . $this->address['phone']); //genera un password con la primera letra de su nombre + un telefono

        $carrier->save();

        //una vez creado se asigna el rol de cliente
        $carrier->assignRole('carrier');

        Log::debug('Carrier creado :' . $carrier);

        //crear direccion de envio

        $address = new Address();

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
        $address->user_id = $carrier->id; //el usuario al cual le pertenece la direccion
        $address->district_id  = $this->address['district_id']; //el usuario al cual le pertenece la direccion

        $address->save();
        //Log::debug('Direccion de envio creado :'.$address);

        $this->emit('creado'); //SweetAlert2
        //$this->emitTo('user.sales.edit-sale.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('components.carriers.show-carrier-all', 'render');  //Refresca el componente ShowAddressAll

    }


    public function render()
    {

        $districts = $this->showDistricts($this->namedistrict);

        return view('livewire.components.carriers.create-carrier', compact('districts'));
    }
}
