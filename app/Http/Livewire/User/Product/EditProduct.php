<?php

namespace App\Http\Livewire\User\Product;
use Livewire\Component;
use App\Models\Product;

class EditProduct extends Component
{

    public $listeners = [
        'refreshProductEdit' => 'refreshProductEdit'
    ];

    public $product;

    public function refreshProductEdit(){
        $this->product = $this->product->fresh();
    }

    public function mount(Product $product){
        $this->product = $product;

    }
    
    public function render()
    {
        $product = $this->product;
        return view('livewire.user.product.edit-product',compact('product'))->layout('layouts.user');
    }
}
