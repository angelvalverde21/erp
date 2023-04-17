<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use App\Models\Album;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowAlbums extends Component
{

    
    public $store;
    
    public function mount(){

        $this->store = Request::get('store');

        //$this->user = Auth::user();
        
        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function render()
    {
        $albums = Album::all();
        return view('livewire.manage.products.edit-product.show-albums',compact('albums'));
    }
}
