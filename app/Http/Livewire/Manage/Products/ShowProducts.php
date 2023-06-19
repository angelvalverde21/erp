<?php

namespace App\Http\Livewire\Manage\Products;

use App\Models\Category;
use App\Models\ColorSize;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowProducts extends Component
{

    public $store; //si uso public esta variable lo podre usar en la plantilla
    //private $store; //si uso private podre usar esta palabra pero con $this en la plantilla

    public $search;

    public function mount(){
        $this->store = Request::get('store');

        //recalcular el stock


    }

    public function deleteProduct(Product $product){

        $product->status = 3;
        $product->save();
        $this->store = $this->store->fresh();
        $this->emit('eliminado');

    }

    public function render()
    {

        // $products = $this->store->products;

        if($this->search <> ""){

            $products = Product::where('store_id', $this->store->id)->where('status',Product::PUBLICADO)->where('name','LIKE','%'. $this->search .'%')->orderBy('quantity','desc')->limit(30)->get();
            
            Log::info($this->search);

        }else{
            
            $products = Product::where('store_id', $this->store->id)->where('status',Product::PUBLICADO)->orderBy('quantity','desc')->limit(30)->get();

            //recalcular el stock de todos los productos



        }

        $categories = Category::all();


        return view('livewire.manage.products.show-products',compact('products', 'categories'))->layout('layouts.manage');

    }

}
