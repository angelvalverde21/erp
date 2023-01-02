<?php

namespace App\Http\Livewire\Store\Products;

use Livewire\Component;

class ShowProducts extends Component
{

    public function mount($nickname){
        $this->nickname = $nickname;
    }

    public function render()
    {

        $nickname = $this->nickname;

        return view('livewire.store.products.show-products',compact('nickname'))->layout('layouts.store');;
    }
}