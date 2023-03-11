<?php

namespace App\Http\Livewire\Manage\Productions;

use App\Models\Production;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

class ShowProductions extends Component
{

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {

        $productions = Production::all();

        return view('livewire.manage.productions.show-productions',compact('productions'))->layout('layouts.manage');
    }
}
