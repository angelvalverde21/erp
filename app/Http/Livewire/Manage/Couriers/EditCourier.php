<?php

namespace App\Http\Livewire\Manage\Couriers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditCourier extends Component
{

    public $courier;

    public function mount(User $courier){

        $this->courier = $courier;

        $this->store = Request::get('store');

    }

    public function render()
    {
        return view('livewire.manage.couriers.edit-courier')->layout('layouts.manage');
    }
}
