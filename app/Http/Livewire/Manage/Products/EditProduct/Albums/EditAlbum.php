<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Albums;

use App\Models\Album;
use App\Models\Location;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditAlbum extends Component
{
    public $album, $store;

    protected $listeners = ['render'=>'render'];

    public function mount(Album $album){

        $this->album = $album;

        $this->store = Request::get('store');
        
    }

    public function render()
    {

        Log::info('renderizado edit album');

        $album = $this->album;

        // $album_id = $album->id;

        // $locations = Location::whereHas('albums', function ($query) use ($album_id) {
        //     $query->where('album_id', $album_id)->withPivot('id')
        //           ->orderBy('id');
        // })
        // ->get();

        return view('livewire.manage.products.edit-product.albums.edit-album',compact('album'))->layout('layouts.manage');
    }
}
