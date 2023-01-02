<?php

namespace App\Http\Livewire\Components\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CardShowProfileUser extends Component
{

    //Si los nombres no estan correctamente definidos no se enviara por wire:model
    protected $rules = [
        'user.name'=>'required',
        'user.dni' => 'required|unique:users,dni',
        'user.phone' => 'required|unique:users,phone',
        'user.email' => 'required|unique:users,email',
        'user.birthday' => 'required'
    ];


    public function refreshUser(){
        $this->user = $this->user->refresh();
    }
    
    public function mount(){

        $this->user = Auth::user();

    }

    public function save(){

        Log::debug($this->user);

        $rules = $this->rules;

        $rules['user.email'] = 'required|unique:users,email,'.$this->user->id;
        $rules['user.dni'] = 'required|unique:users,dni,'.$this->user->id;
        $rules['user.phone'] = 'required|unique:users,phone,'.$this->user->id;
        Log::debug('No paso la validacion');
        $this->validate($rules);
        Log::debug('paso la validacion');
        Log::debug($this->user);
        //$this->product->slug = $this->slug;
        
        $this->user->name = $this->user['name'];
        $this->user->birthday = $this->user['birthday'];

        $this->user->save();
        $this->emit('actualizado');
    }

    public function render()
    {
        return view('livewire.components.profile.card-show-profile-user');
    }
}
