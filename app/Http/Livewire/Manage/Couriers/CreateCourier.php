<?php

namespace App\Http\Livewire\Manage\Couriers;

use Livewire\Component;

class CreateCourier extends Component
{
    public function render()
    {
        return view('livewire.manage.couriers.create-courier')->layout('layouts.manage');
    }
}
