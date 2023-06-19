<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Colors\Albums;

use App\Models\Color;
use Livewire\Component;

class CreateAlbumColor extends Component
{
    public $color;

    public function mount(Color $color){
        $this->color = $color;
    }

    public function render()
    {
        return view('livewire.manage.products.edit-product.colors.albums.create-album-color')->layout('layouts.manage');
    }
}
