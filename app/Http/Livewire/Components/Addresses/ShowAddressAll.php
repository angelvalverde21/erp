<?php

namespace App\Http\Livewire\Components\Addresses;

use App\Models\Address;
use App\Models\District;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ShowAddressAll extends Component
{

    protected $listeners = [
        'render' => 'render',
    ];

    public $user;
    public $model_refer;
    public $model_refer_id;
    public $model;
    public $render;
    public $address_selected;
    public $address;

    public function mount(User $user, $model_refer = '', $model_refer_id = '', $render = '')
    {

        // $this->user = User::find($user_id)->whereHas('addresses', function ($query) {
        //     $query->orderBy('updated_at','desc');
        // })->first();


        $this->render = $render;
        $this->user = $user;

        if ($model_refer) {
            $this->model_refer = $model_refer;
            $this->model_refer_id = $model_refer_id;
        }

        $Instance = trim("App\Models\ ") . $model_refer;
        $Object = New $Instance;
        $this->model = $Object::findOrFail($model_refer_id);

        // switch ($this->model_refer) {
        //     case 'Order':
        //         $this->model = Order::find($this->model_refer_id);

        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }

        //$this->user_id = $this->order->buyer_id;

    }

    public function selectAddress(Address $address)
    {
        $this->address = $address;

        // Log::info('La orden que se quiere cambiar es: ' . $this->order);
        // Log::info('el valor del address_id que cambiaremos es: ' . $address);
        // Log::info('DIRECCION: ' . $address);
        // Log::info('El model_refer ' . $this->model_refer);
        // Log::info('El model_refer ' . $this->model_refer_id);

        $this->model->address_id = $this->address->id;
        $this->model->save();

        $this->emitTo('components.addresses.show-address', 'refreshCard');
        //$this->emitSelf('render');
        
        $this->emit('address-selected');
    }

    public function render()
    {
        $this->address_selected = $this->model->address_id;

        $addresses = Address::showAll($this->user->id);

        return view('livewire.components.addresses.show-address-all', compact('addresses'));
    }
}
