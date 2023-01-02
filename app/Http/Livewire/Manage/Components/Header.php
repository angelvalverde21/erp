<?php

namespace App\Http\Livewire\Manage\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Header extends Component
{
    public $store;

    public function mount(){
                //Este requeste viene desde el middleware StoreExist.php
                $this->store = Request::get('store');
                $this->product = Request::get('product');
                $this->user = Auth::user();
    }

    public function render(User $nickname)
    {

        if(isset($nickname)){
            $store = $nickname;
        }else{
            $this->store->nickname = 'test';
        }
        

        return view('livewire.manage.components.header',compact('store'));
    }
}
