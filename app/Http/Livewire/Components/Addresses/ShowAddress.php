<?php

namespace App\Http\Livewire\Components\Addresses;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ShowAddress extends Component
{
    protected $listeners = ['render'=>'render', 'refreshCard'=>'refreshCard'];


    
    public function mount(Address $address, $model_refer = '', $model_refer_id = ''){
        
        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();

        Log::info('SE MONTO EL COMPONENTE: ' . $address);

        $this->address = $address;
        
        if($model_refer){

            $this->model_refer = $model_refer;
            $this->model_refer_id = $model_refer_id;

            $Instance = trim("App\Models\ ") . $model_refer;
            $Object = New $Instance;
            $this->model = $Object::find($model_refer_id);

        }

    }

    public function refreshCard(){
        $this->address = Address::find($this->model->address_id);
        //Esto refresca todos los componentes livewire incluidos en el card
    }
    

    public function render()
    {

        $address = $this->address;
        Log::info('ShowAddress.php: SE RENDERIZO EL COMPONENTE: ' . $address);
        Log::info('ShowAddress.php: el model es: ' . $this->model);
        return view('livewire.components.addresses.show-address',compact('address'));
        
    }
}