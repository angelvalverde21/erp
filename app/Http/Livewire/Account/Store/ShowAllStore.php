<?php

namespace App\Http\Livewire\Account\Store;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowAllStore extends Component
{
   
    public function mount(){

        //$user = Auth::user();
        $user = Auth::user();
    
        $this->stores = $user->stores;

        Log::info($this->stores);
        
    }

    public function render()
    {
        $stores = $this->stores;

        return view('livewire.account.store.show-all-store',compact('stores'))->layout('layouts.adminlte');
    }

}
