<?php

namespace App\Http\Livewire\User\Product\Components;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Inputs extends Component
{
    protected $rules = [
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required',
        'product.price_seller' => 'required'
    ];

    public $product, $slug;

    public function mount(Product $product){

        //Log::debug($product);

        $this->product = $product;
        
    }

    public function save(){

        $rules = $this->rules;
        $rules['product.slug'] = 'required|unique:products,slug,'.$this->product->id;

        $this->validate($rules);
        
        //$this->product->slug = $this->slug;

        Log::debug($this->product);
        $this->product->save();
        $this->emit('actualizado');

    }

    public function updatedProductName($value){
        //Log::debug($value);
        $this->product->slug = Str::slug($value);
    }

    public function updatedCategoryId($value){
        $this->subcategories = Subcategory::where('category_id', $value)->get();
    }

    public function render()
    {
        return view('livewire.user.product.components.inputs');
    }
}
