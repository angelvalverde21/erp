<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CreateAlbum extends Component
{
    
    public $listeners = [
        'render' => 'render'
    ];

    public $album, $store, $user;

    protected $rules = [
        'album.description'=>'',
        'album.name' => 'required',
        // 'album.slug' => 'required|unique:products,slug',
        // 'album.price' => 'required'
    ];

    
    public function mount(){

        $this->store = Request::get('store');

        $this->user = Auth::user();
        
        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function save(){

        //$rules = $this->rules;
        //
        $this->validate($this->rules);
        
        $album = new Album();

        $album->name = $this->album['name'];
        $album->store_id = $this->store->id;
        $album->description = $this->album['description'];
        
        $album->save();

    }

    public function render()
    {
        return view('livewire.manage.products.edit-product.create-album');
    }
}
