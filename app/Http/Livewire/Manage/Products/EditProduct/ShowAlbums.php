<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use App\Models\Album;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowAlbums extends Component
{

    
    public $store;
    public $product;
    
    public function mount($product){

        $this->store = Request::get('store');

        $this->product = $product;
        //$this->user = Auth::user();
        
        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function render()
    {

        // $albums = $this->product->albums;
        $product = $this->product;

        return view('livewire.manage.products.edit-product.show-albums',compact('product'));

    }
}
