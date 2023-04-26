<?php

namespace App\Http\Livewire\Components\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class CardShowProfileStore extends Component
{

    public $user;

    //Si los nombres no estan correctamente definidos no se enviara por wire:model
    protected $rules = [

        'user.name'=>'required',
        'user.contact.whatsapp'=>'', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.phone' => 'required|unique:users,phone',
        'user.email' => 'required|unique:users,email',
        'user.nickname' => 'required|unique:users,nickname'

    ];

    public function refreshUser(){

        $this->user = $this->user->refresh();
    
    }
    
    public function mount(){

        $this->user =  Request::get('store');
        Log::debug($this->user);

    }

    public function save(){

        Log::debug($this->user);
        
        $rules = $this->rules;

        $rules['user.email'] = 'required|unique:users,email,'.$this->user->id;
        $rules['user.phone'] = 'required|unique:users,phone,'.$this->user->id;
        $rules['user.nickname'] = 'required|unique:users,nickname,'.$this->user->id;

        Log::debug('No paso la validacion');
        $this->validate($rules);
        Log::debug('paso la validacion');
        Log::debug($this->user);

        //$this->product->slug = $this->slug;
    
        // $data =  [
        //     'whatsapp' => $this->user['data']['whatsapp'],
        // ];

        // $this->user->data = $data;

        $data_upload = [
            'logo' => $this->user['logo'],
            'logo_invoice' => $this->user['logo_invoice'],
            'qr_yape' => $this->user['qr_yape'],
            'qr_plin' => $this->user['qr_plin'],
        ];

        $this->user->save();
        $this->emit('actualizado');

        redirect()->route('manage.profile', ['nickname' => $this->user->nickname]);
    }


    public function render()
    {
        $user = $this->user;
        return view('livewire.components.profile.card-show-profile-store',compact('user'));
    }
}
