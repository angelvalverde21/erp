<?php

namespace App\Http\Livewire\Manage\WareHouses;

use Livewire\Component;

class ShowWareHouses extends Component
{

    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.manage.ware-houses.show-ware-houses')->layout('layouts.manage');
        
    }
}
