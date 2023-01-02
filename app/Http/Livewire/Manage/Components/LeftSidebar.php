<?php

namespace App\Http\Livewire\Manage\Components;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class LeftSidebar extends Component
{

    public function mount(){
        //Este requeste viene desde el middleware StoreExist.php
        $this->store = Request::get('store');
        $this->product = Request::get('product');
    }
    
    public function render()
    {
        $store = $this->store;
        return view('livewire.manage.components.left-sidebar',compact('store'));
    }

}
