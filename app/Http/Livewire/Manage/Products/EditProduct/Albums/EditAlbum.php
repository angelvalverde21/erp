<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Albums;

use App\Models\Album;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditAlbum extends Component
{
    public $album, $store;

    public function mount(Album $album){
        $this->album = $album;

        $this->store = Request::get('store');
        
    }

    public function render()
    {
        $album = $this->album;

        return view('livewire.manage.products.edit-product.albums.edit-album',compact('album'))->layout('layouts.manage');
    }
}
