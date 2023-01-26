<?php

namespace App\Http\Livewire\Manage\Products;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class EditProduct extends Component
{

    use AuthorizesRequests;

    protected $rules = [
        'product.name' => 'required',
        'product.slug' => 'required|unique:products,slug',
        'product.price' => 'required',
        'product.price_seller' => 'required'
    ];

    public $listeners = [
        'refreshProductEdit' => 'refreshProductEdit'
    ];

    public $product, $slug, $store;

    public function mount(Product $product){

        //Log::debug($product);
        $this->store = Request::get('store');
        
        Log::info($this->store);
        

        // $store = User::findOrFail($this->store->id);

        if($this->store->id == $product->store_id){
            $this->product = $product;
        }else{
            abort(403);
        }

        //$this->authorize();
        // $this->authorize('owner');

        //$this->authorize()
        
    }

    public function refreshProductEdit(){
        $this->product = $this->product->fresh();
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

    public function render()
    {
        $product = $this->product;

        return view('livewire.manage.products.edit-product',compact('product'))->layout('layouts.manage');
    }


}
