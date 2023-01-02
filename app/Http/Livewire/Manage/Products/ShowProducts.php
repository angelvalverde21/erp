<?php

namespace App\Http\Livewire\Manage\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowProducts extends Component
{

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {

        $store = $this->store;

        $products = Product::where('status','1')->where('store_id',$this->store->id)->get();

        return view('livewire.manage.products.show-products',compact('store','products'))->layout('layouts.manage');

    }

}
