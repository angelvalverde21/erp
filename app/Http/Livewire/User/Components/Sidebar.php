<?php

namespace App\Http\Livewire\User\Components;

use Livewire\Component;

class Sidebar extends Component
{

    function mount(){

        $user = auth()->user();

        $this->user = $user;

    }

    public function render()
    {
        return view('livewire.user.components.sidebar');
    }
}
