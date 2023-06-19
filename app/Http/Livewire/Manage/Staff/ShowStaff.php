<?php

namespace App\Http\Livewire\Manage\Staff;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowStaff extends Component
{

    public $store;

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {

        $store = $this->store;
        $users = $this->store->repartidores($this->store->id);

        return view('livewire.manage.staff.show-staff', compact('store','users'))->layout('layouts.manage');
    }
}
