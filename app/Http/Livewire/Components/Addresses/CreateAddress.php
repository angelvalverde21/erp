<?php

namespace App\Http\Livewire\Components\Addresses;


use App\Models\Address;
use App\Models\District;
use App\Models\User;
use App\Traits\AddressTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CreateAddress extends Component
{

    use AddressTrait;

    public $render, $user;

    public function mount($user_id, $render = ''){

        $this->user =  User::find($user_id);
        //$this->user['user_id'] = $this->user->id;

        $this->SendToInput($this->user);

        $this->render = $render;
    
        // $this->address['user_id'] = $this->user->id;
        // $this->address['name'] = $this->user->name;
        // $this->address['phone'] = $this->user->phone;
        // $this->address['dni'] = $this->user->dni;
        // $this->address['primary'] = '';
        // $this->address['secondary'] = '';
        // $this->address['references'] = '';
        // $this->namedistrict = '';


    }

    public function save(){


        Log::debug('Empezamos la validacion');
        //Log::info('se paso la validacion: '. $this->validate($this->rules));
        $this->validate($this->rules);

        $address = new Address();

        $address = $this->loadValuesTemplateForAddress($address);

        // $address->name = $this->address['name'];
        // $address->phone = $this->address['phone'];
        // $address->references = $this->address['references'];
        // $address->primary = $this->address['primary'];
        // $address->secondary = $this->address['secondary'];

        // if ($this->address['dni']>0){
        //     $address->dni = $this->address['dni'];
        // }else{
        //     $address->dni = null;
        // }

        // $address->district_id = $this->address['district_id'];
        // $address->user_id = $this->address['user_id'];

        Log::debug('Se paso la validacion: '.$address);

        $address->save();

        //Actualizar la direccion por defecto del usuario

        $address->user->address_id = $address->id;

        $address->user->save();

        //$this->emitTo('components.addresses.show-address','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('components.addresses.show-address-all','render');  //Refresca el componente ShowAddressAll
        
        if($this->render <> ""){
            
            $this->emit($this->render,'render');  //Refresca el componente ShowAddressAll
            
        }
        
        $this->emit('creado'); //SweetAlert2

        //Cierra el modal de crear direccion y todas las direcciones contenidas en el modal
        //$this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#show-all-address-modal']);
        //$this->modal = false;

    }



    // public function test(){
    //     $this->emit('creado'); //SweetAlert2
    //     $this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#show-all-address-modal']);
    // }


    // function districtAdd($value){

    //     $district = District::with(['province.department'])->find($value);

    //     $this->namedistrict = $district->name.' - '.$district->province->name.' - '.$district->province->department->name;

    //     $this->address['district_id'] = $value;
    // }


    public function render()
    {
        // Log::debug($this->namedistrict);

        $districts = $this->showDistricts($this->namedistrict);

        // if ($this->namedistrict <> "") {
            
        //     $districts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
        //     ->orderBy('name', 'asc')
        //     ->paginate(10);
        
        // }else{
        //     //$districts = District::all();
        //     $districts = [];
        // }

        return view('livewire.components.addresses.create-address', compact('districts'));
    }

}
