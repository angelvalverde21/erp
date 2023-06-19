<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use App\Models\Album;
use App\Models\Location;
use App\Models\User;
use App\Traits\AddressTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class CreateAlbum extends Component
{
    
    // use AddressTrait;

    public $listeners = [
        'render' => 'render'
    ];

    public $album, $store, $user, $product;

    protected $rules = [
        'album.description'=>'',
        'album.name' => 'required',
        'album.modelo_id' => 'required',
        'album.store_id' => '',
        'album.product_id' => '',
        // 'album.slug' => 'required|unique:products,slug',
        // 'album.price' => 'required'
    ];

    
    public function mount($product){

        $this->store = Request::get('store');

        $this->user = Auth::user();
        $this->product = $product;
        
        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function save(){

        //$rules = $this->rules;
        //

        Log::info('Empezando la validacion');

        $this->validate($this->rules);
        
        $album = new Album();

        $album->name = $this->album['name'];
        $album->modelo_id = $this->album['modelo_id'];
        $album->description = $this->album['description'];
        $album->store_id = $this->store->id;
        $album->product_id = $this->product->id;
        
        $album->save();

        $this->emit('creado');

        return redirect()->route('manage.products.albums.edit', ['nickname' => $this->store->nickname, 'product' => $this->product->id, 'album' => $album->id]);
        
        Log::info('se creo el album');

    }

    public function render()
    {

        $modelos = User::modelos();

        // $locations = Location::all();
        // $districts = $this->showDistricts($this->namedistrict);
        return view('livewire.manage.products.edit-product.create-album', compact('modelos'))->layout('layouts.manage', ['title' => 'Crear Album']);

    }
}
