<?php

namespace App\Http\Livewire\Account\Comunes;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    public $store, $user;

    public function mount()
    {
        //Este requeste viene desde el middleware StoreExist.php
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire..account.comunes.header');
    }
}
