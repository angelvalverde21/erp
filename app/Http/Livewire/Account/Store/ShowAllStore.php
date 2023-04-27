<?php

namespace App\Http\Livewire\Account\Store;

use App\Models\RoleStoreUser;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowAllStore extends Component
{
    public $user, $stores;

    public function mount()
    {

        //$user = Auth::user();
        $this->user = Auth::user();

        $this->stores = $this->user->stores;

        // Log::info($this->stores);
    }

    public function render()
    {

        // $stores = $this->user->stores; //Esto falla cuando se usa el compact, para tenerlo en cuenta

        return view('livewire.account.store.show-all-store')->layout('layouts.adminlte');
    }
}
