<?php

//ojo esto es una plantilla

namespace App\Http\Livewire;

use Livewire\Component;

class Peruanitos extends Component
{
    public function render()
    {
        return view('livewire.manage.personalizado.peruanitos')->layout('layouts.manage');
    }
}
