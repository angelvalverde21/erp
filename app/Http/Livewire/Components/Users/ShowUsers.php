<?php

namespace App\Http\Livewire\Components\Users;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowUsers extends Component
{

    protected $listeners = ['render' => 'render'];
    
    public $store, $rol, $users;

    public function mount($rol = 'buyer'){
        
        $this->store = Request::get('store');

        $this->users = $this->store->whereHas(
            'roles',
            function ($q) use ($rol) {
                $q->where('name', $rol);
            }
        )->orderBy('id','desc')->limit(50)->get();

        $this->rol = $rol;
    }

    public function render()
    {

        // $rol = $this->rol;

        // $customers = User::where('store_id',$this->store->id)->limit(50)->orderBy('id','desc')->get();

        return view('livewire.components.users.show-users');

    }


}
