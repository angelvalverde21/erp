<?php

namespace App\Http\Livewire\User\Components\Addresses;

use App\Models\Address;
use App\Models\District;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CreateAddress extends Component
{

    public $address, $namedistrict, $modal;
    protected $listeners = ['districtAdded' => 'districtAdded'];

    protected $rules = [
        'address.name' => 'required',
        'address.phone' => 'required',
        'address.primary' => 'required',
        'address.district_id' => 'required',
        'address.user_id' => 'required'
    ];

    public function mount($user_id){

        $this->user =  User::find($user_id);
        

        $this->address['user_id'] = $this->user->id;
        $this->address['name'] = $this->user->name;
        $this->address['phone'] = $this->user->phone;
        $this->address['dni'] = $this->user->dni;
        $this->address['references'] = '';
        $this->address['secondary'] = '';
        $this->namedistrict = '';

        $this->modal = true;

    }

    public function save(){

        $rules = $this->rules;

        //Log::debug($this->address);

        $this->validate($rules);

        $address = new Address();

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
        $address->user_id = $this->address['user_id'];

        Log::debug('Se paso la validacion: '.$address);

        $address->save();

        $this->emit('creado'); //SweetAlert2
        $this->emitTo('user.components.addresses.show-address-default','render'); //Refresca la tarjeta por defecto que se muestra en el blade
        $this->emitTo('user.components.addresses.show-address-all','render');  //Refresca el componente ShowAddressAll


          $this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#show-all-address-modal']);
        // $this->modal = false;

    }

    public function test(){
        $this->emit('creado'); //SweetAlert2
        $this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#show-all-address-modal']);
    }

    function districtAdded($value){
        //Log::debug($value);

        $district = District::with(['province.department'])->find($value);
        //$district = District::find($value)->province;
        //$district = District::find($value)->province->department;
        //$province = Province::find($district->province_id);
        // $district = new District();
        // $district = District::whereHas('province', function($q) use ($value) {
        //     $q->where('id', $value);
        // })->get();

        $this->namedistrict = $district->name.' - '.$district->province->name.' - '.$district->province->department->name;
        
        //Log::debug($district);
        //Log::debug($province);

        $this->address['district_id'] = $value;
    }


    public function render()
    {
                // Log::debug($this->namedistrict);

                if ($this->namedistrict <> "") {
            
                    $districts = District::with(['province.department'])->where('name', 'like', '%' . $this->namedistrict . '%')
                    ->orderBy('name', 'asc')
                    ->paginate(10);
        
                }else{
                    //$districts = District::all();
                    $districts = [];
                }

        return view('livewire.user.components.addresses.create-address', compact('districts'));
    }
}
