<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;
use Livewire\Component;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class Images extends Component
{
    public $product;
    
    //protected $listeners = ['refreshProductx']; //cuando laravel escuche este evento buscara un metodo con el mismo nombre
    
    // function refreshProduct(){
    //     $this->product = $this->product->fresh();
    // }

    protected $listeners = ['refreshImages']; 


    public function mount(){
        $this->store = Request::get('store');
    }

    public function refreshImages(){
        $this->product = $this->product->fresh();
    }
    
    public function deleteImage(Image $image){

        //Borra los archivos de la carpeta del servidor
        Storage::delete([$image->name]);

        //Borra los registros de la base de datos
        $image->delete();

        //Actualizamos todo el producto
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        return view('livewire.manage.products.edit-product.images');
    }
}
