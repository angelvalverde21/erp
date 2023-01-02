<?php

namespace App\Http\Livewire\Components\Profile;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

class CardStoreWallet extends Component
{

    //public $user;

    //Si los nombres no estan correctamente definidos no se enviara por wire:model
    protected $rules = [

        'user.wallet.yape' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.wallet.titular_yape' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.wallet.code_yape' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.wallet.plin' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.wallet.titular_plin' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)
        'user.wallet.code_plin' => '', //OJO PARA QUE FUNCIONE CORRECTAMENTE ESTOS CAMPOS CON JSON NO DEBEN SER OBLIGATORIOS (REQUIRED)

    ];

    public function mount()
    {
        $this->user =  Request::get('store');
        Log::info('INICIO logo desde card store wallet');
        Log::debug($this->user);
        Log::info('FIN logo desde card store wallet');
    }

    public function refreshUser()
    {
        $this->user = $this->user->refresh();
    }

    public function save()
    {
        $this->user->save();
        $this->emit('actualizado');
    }

    public function render()
    {

        $user = $this->user;
        return view('livewire.components.profile.card-store-wallet',compact('user'));
    }
}
