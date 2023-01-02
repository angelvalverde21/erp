<?php

namespace App\Http\Livewire\User\Profile\Addresses;

use App\Models\Address;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Log;

class EditAddress extends Component
{


    protected $listeners = ['AddressDistrictAdded'=>'AddressDistrictAdded'];
    
    protected $rules = [
        'address.name' => 'required',
        'address.phone' => 'required',
        'address.primary' => 'required',
        'address.dni' => '',
        'address.secondary' => '',
        'address.references' => '',
        'address.district_id' => 'required',
        'address.user_id' => 'required'
    ];

    public $address, $districts, $namedistrict;

    function mount(Address $address){

        $this->address = $address;
        $this->address['name'] = $address->name;
        $this->address['phone'] = $address->phone;
        $this->address['dni'] = $address->dni;
        $this->address['references'] = $address->references;
        $this->address['secondary'] = $address->secondary;
        $this->address['district_id'] = $address->district_id;
        $this->address['user_id'] = $address->user_id;
        $this->namedistrict = $address->district->name.' - '.$address->district->province->name.' - '.$address->district->province->department->name;
        //$this->address = $address->name;
    }

    public function save(){

        $rules = $this->rules;

        //Log::debug($this->address);

        $this->validate($rules);

        $address = $this->address;

        $address->name = $this->address['name'];
        $address->phone = $this->address['phone'];
        $address->references = $this->address['references'];
        $address->primary = $this->address['primary'];
        $address->secondary = $this->address['secondary'];

        if ($this->address['dni']>0){
            $address->dni = $this->address['dni'];
        }else{
            $address->dni = null;
        }

        $address->district_id = $this->address['district_id'];
        $address->user_id =  $this->address['user_id'];

        Log::debug('Se paso la validacion: '.$address);

        $address->save();
        
        $this->emit('actualizado');
        $this->emit('refreshAddresses');

    }

    function deleteAddress(Address $address){
        $address->delete();
        $this->emit('refreshAddresses');
        //$this->address = $address->fresh();
    }

    function AddressDistrictAdded($value){

        $district = District::with(['province.department'])->find($value);
        //$district = District::find($value)->province;
        //$district = District::find($value)->province->department;
        $province = Province::find($district->province_id);
        // $district = new District();
        // $district = District::whereHas('province', function($q) use ($value) {
        //     $q->where('id', $value);
        // })->get();

        /* 
            Con esta propiedad le decimos a laravel que el valor de namedistrict sera por ejemplo "LIMABAMBA - RODRIGUEZ DE MENDOZA - AMAZONAS"
            Entonces al detectar un nuevo valor se ejecutara el render y enseguida el render intentara buscar la cadadea "LIMABAMBA - RODRIGUEZ DE MENDOZA - AMAZONAS"
            y devolvera cero columnas con lo que el cuadro desplegable desaparecera
        */
        $this->namedistrict = $district->name.' - '.$district->province->name.' - '.$district->province->department->name;
        
        //Log::debug($district);
        //Log::debug($province);

        $this->address['district_id'] = $value;
    }

    public function render()
    {
        
        if ($this->namedistrict <> "") {

            Log::debug($this->namedistrict);
            $addressDistricts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
            ->orderBy('name', 'asc')
            ->paginate(10);
        }else{
            //$districts = District::all();
            $addressDistricts = [];
        }

        return view('livewire.user.profile.addresses.edit-address',compact('addressDistricts'));
    }
}
