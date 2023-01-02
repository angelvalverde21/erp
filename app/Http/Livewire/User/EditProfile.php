<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EditProfile extends Component
{
    //Si los nombres no estan correctamente definidos no se enviara por wire:model
    protected $rules = [
        'user.name'=>'required',
        'user.dni' => 'required|unique:users,dni',
        'user.celular' => 'required|unique:users,celular',
        'user.email' => 'required|unique:users,email',
        'user.birthday' => 'required'
    ];

    
    public function mount(){

        $user = new User();
        $user = auth()->user();
        $this->user = $user;

    }

    public function save(){

        Log::debug($this->user);

        $rules = $this->rules;

        $rules['user.email'] = 'required|unique:users,email,'.$this->user->id;
        $rules['user.dni'] = 'required|unique:users,dni,'.$this->user->id;
        $rules['user.celular'] = 'required|unique:users,celular,'.$this->user->id;
        //Log::debug($this->user);
        $this->validate($rules);
        
        //$this->product->slug = $this->slug;

        
        $this->user->save();
        $this->emit('actualizado');
    }

    public function render()
    {
        return view('livewire.user.edit-profile')->layout('layouts.user');
    }
}
