<?php

namespace App\Http\Livewire\Manage;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.manage.dashboard')->layout('layouts.manage');;
    }
}
