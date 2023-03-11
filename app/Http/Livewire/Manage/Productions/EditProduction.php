<?php

namespace App\Http\Livewire\Manage\Productions;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditProduction extends Component
{

    public $store;
    
    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {
        return view('livewire.manage.productions.edit-production')->layout('layouts.manage');
    }
}
