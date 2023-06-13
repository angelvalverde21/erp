<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Albums;

use App\Models\Album;
use App\Models\Location;
use App\Models\Photo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditAlbum extends Component
{
    public $album, $store, $perPage;

    protected $listeners = ['render' => 'render'];

    public function mount(Album $album)
    {

        $this->album = $album;
        $this->perPage = 20;
        $this->store = Request::get('store');
    }

    public function loadImages()
    {
        // Lógica para cargar las imágenes de acuerdo a la página actual y la cantidad por página
        // $offset = ($this->currentPage - 1) * $this->perPage;
        // $this->images = Image::skip($offset)->take($this->perPage)->get();
    }

    public function delete($url_path_original){

        Log::info('se hizo click');

        $photo = Photo::where('large', '=', $url_path_original)->limit(1)->first();

        if($photo){

            Log::info('se borro correctamente');

            Storage::disk('spaces')->delete($photo->large);
            Storage::disk('spaces')->delete($photo->medium);
            Storage::disk('spaces')->delete($photo->thumbnail);
    
            // finalmente elimino el registro
    
            $photo->delete();
        }else{
            Log::info('no se ha encontrado la photo para eliminar');
        }

        $this->album = $this->album->fresh();

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

        return view('livewire.manage.products.edit-product.albums.edit-album', compact('album'))->layout('layouts.manage');
    }
}
