<?php

namespace App\Http\Livewire\User\Profile;


use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ShowProfile extends Component
{



    public $user;
    //Si los nombres no estan correctamente definidos no se enviara por wire:model
    protected $rules = [
        'user.name'=>'required',
        'user.dni' => 'required|unique:users,dni',
        'user.phone' => 'required|unique:users,phone',
        'user.email' => 'required|unique:users,email',
        'user.nickname' => 'unique:users,nickname',
        'user.birthday' => 'required'
    ];


    public function refreshUser(){
        $this->user = $this->user->refresh();
    }
    
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
        $rules['user.phone'] = 'required|unique:users,phone,'.$this->user->id;
        //Log::debug($this->user);
        $this->validate($rules);
        
        //$this->product->slug = $this->slug;

        
        $this->user->save();
        $this->emit('actualizado');
    }

    public function render()
    {

        return view('livewire.user.profile.show-profile')->layout('layouts.user');
    }
}
