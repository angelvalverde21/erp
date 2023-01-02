<?php

namespace App\Http\Livewire\Account\Store;

use App\Http\Livewire\Web\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowStore extends Component
{



    public function render()
    {


        return view('livewire.account.store.show-store')->layout('layouts.adminlte');
    }
}
