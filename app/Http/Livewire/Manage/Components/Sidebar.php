<?php

namespace App\Http\Livewire\Manage\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;


class Sidebar extends Component
{

    public function mount(){
        //Este requeste viene desde el middleware StoreExist.php
        $this->user = Auth::user();
        $this->store = Request::get('store');
        $this->product = Request::get('product');
    }
    
    public function render()
    {
        $store = $this->store;
        return view('livewire.manage.components.sidebar',compact('store'));
    }


}
