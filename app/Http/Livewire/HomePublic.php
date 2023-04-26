<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomePublic extends Component
{
    public function render()
    {
        return view('livewire.home-public')->layout('layouts.alone');
    }
}
