<?php

namespace App\Http\Livewire\Manage\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowProducts extends Component
{

    public $store; //si uso public esta variable lo podre usar en la plantilla
    //private $store; //si uso private podre usar esta palabra pero con $this en la plantilla

    public function mount(){
        $this->store = Request::get('store');
    }

    public function deleteProduct(Product $product){

        $product->delete();
        $this->store->products = $this->store->products->fresh();
        $this->emit('eliminado');

    }

    public function render()
    {

        $products = $this->store->products;
        return view('livewire.manage.products.show-products',compact('products'))->layout('layouts.manage');

    }

}
