<?php

//ojo esto es una plantilla

namespace App\Http\Livewire;

use Livewire\Component;

class {{ $nameComponent }} extends Component
{

    public function mount(){
    }

    public function render()
    {
        return view('{{ $pathNameView }}')->layout('layouts.manage');
    }
}
