<?php

namespace App\Http\Livewire\Account\Store;

use App\Models\RoleStoreUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateStore extends Component
{


    public $store; //es necesario hacer que esta variable sea publica para poder acceder al archivo blade

    protected $rules = [
        'store.name' => 'required',
        'store.phone' => 'required',
        'store.email' => 'required',
        'store.nickname' => 'required|unique:users,nickname',
    ];
    
    public function save(){
        Log::info($this->store);

        //Primero creamos el nuevo store en la tabla users

        $store = New User();

        $store->name = $this->store['name'];
        $store->phone = $this->store['phone'];
        $store->email = $this->store['email'];
        $store->nickname = $this->store['nickname'];
        $store->password = bcrypt($this->store['nickname']);

        $store->save();


        $newRoleStore = new RoleStoreUser();

        $newRoleStore::create([
            "user_id" => Auth::id(), //este es el propietario de la pagina
            "role_id" => 12, // 12 es la clave para indicar que es un admin de la pagina
            "store_id" => $store->id,
        ]);
        
        $this->emit('actualizado');

        redirect('/account');
    }

    public function render()
    {
        return view('livewire.account.store.create-store')->layout('layouts.adminlte');
        
    }
}
