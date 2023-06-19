<?php

namespace App\Http\Livewire\Manage\Couriers;

use App\Models\User;
use Livewire\Component;

class ShowCouriers extends Component
{
    public function render()
    {

        $couriers = User::carriers();

        return view('livewire.manage.couriers.show-couriers', compact('couriers'))->layout('layouts.manage');
    }
}
