<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Homeuser extends Component
{
    public function render()
    {
        return view('livewire.homeuser')->layout('layouts.manage');;
    }
}
