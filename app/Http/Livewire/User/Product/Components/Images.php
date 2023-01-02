<?php

namespace App\Http\Livewire\User\Product\Components;

use Livewire\Component;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class Images extends Component
{

    public $product;
    
    //protected $listeners = ['refreshProductx']; //cuando laravel escuche este evento buscara un metodo con el mismo nombre
    
    // function refreshProduct(){
    //     $this->product = $this->product->fresh();
    // }

    protected $listeners = ['refreshImages']; 

    public function refreshImages(){
        $this->product = $this->product->fresh();
    }
    
    public function deleteImage(Image $image){

        //Borra los archivos de la carpeta del servidor
        Storage::delete([$image->url]);

        //Borra los registros de la base de datos
        $image->delete();

        //Actualizamos todo el producto
        $this->product = $this->product->fresh();
    }


    
    public function render()
    {
        return view('livewire.user.product.components.images');
    }
}
