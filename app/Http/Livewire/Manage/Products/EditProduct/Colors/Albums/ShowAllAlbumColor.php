<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Colors\Albums;

use App\Models\Color;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowAllAlbumColor extends Component
{
    public $albums, $store, $color;

    public function mount(Color $color){
        $this->albums = $color->albums;
        $this->store = Request::get('store');
        $this->color = $color;
    }

    public function render()
    {

        $albums = $this->albums; 

        return view('livewire.manage.products.edit-product.colors.albums.show-all-album-color', compact('albums'))->layout('layouts.manage');
    }
}
