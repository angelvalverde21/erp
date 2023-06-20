<?php

namespace App\Http\Livewire\Manage\Albumes;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowAlbumes extends Component
{

    // use AddressTrait;

    public $listeners = [
        'render' => 'render'
    ];

    public $album, $store, $user, $product, $albumes, $name, $album_id;

    protected $rules = [
        'name' => 'required',
        // 'name' => 'required|unique:albums,name',
        // 'album.slug' => 'required|unique:products,slug',
        // 'album.price' => 'required'
    ];


    public function mount($album_id =  null)
    {

        $this->album_id = $album_id;


        $this->store = Request::get('store');

        $this->user = Auth::user();

        if($this->album_id>0){
            $this->albumes = Album::where('parent_id', $this->album_id)->get();
        }else{
            $this->albumes = Album::where('parent_id', 0)->get();
        }

        Log::info($this->albumes);

        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function createPath()
    {

        try {

            $this->validate($this->rules);


            $album = new Album();
    
            $album->name = $this->name;

            $album->slug = Str::slug($this->name);

            if($this->album_id>0){
                $album->parent_id = $this->album_id;
            }
    
            $album->store_id = $this->store->id;
    
            $album->save();
    
            $this->emit('creado');
    
            if($this->album_id>0){
                $this->albumes = Album::where('parent_id', $this->album_id)->get();
            }else{
                $this->albumes = Album::where('parent_id', 0)->get();
            }

        } catch (\Throwable $th) {
            $this->emit('carpeta_exists');
        }

    }

    public function render()
    {

        $albumes = $this->albumes;

        return view('livewire.manage.albumes.show-albumes', compact('albumes'))->layout('layouts.manage');
    }
}
