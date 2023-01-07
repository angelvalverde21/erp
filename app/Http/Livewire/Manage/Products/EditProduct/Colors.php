<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use Livewire\Component;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\ColorSize;
use Illuminate\Support\Facades\Request;

class Colors extends Component
{

    public $product;
    public $stock = [];

    protected $listeners = [
        'render'=>'render',
        'refreshColor'=>'refreshColor',
    ]; //cuando laravel escuche este evento buscara un metodo con el mismo nombre
    
    public function mount(){
        $this->showTotalStock = 10;
        $this->store = Request::get('store');
    }

    public function refreshColor(){
        $this->product = $this->product->fresh();
    }

    public function deleteColor(Color $color){

        Log::info('Imprimiendo datos del color');
        
        Log::debug($color);

        //Borra los archivos de la carpeta del servidor
        Log::info('Imprimiendo el nombre del archivo a eliminar');

        Log::info($color->name);

        Log::info('Borrando el archivo');
        
        Storage::delete([$color->name]);

        //Borra los registros de la base de datos

        //$color = Color::find($colorPost->id);

        Log::debug($color);

        $sizes = $color->sizes;

        Log::debug($sizes);

        foreach ($sizes as $size) {
            $color->sizes()->detach($size->id);
        }

        $color->delete();

        //Each porque eliminara una coleccion de sizes
        //$color->sizes->each->delete();

        $this->product = $this->product->fresh();

        $this->emit('eliminado');

    }

    public function render()
    {
        return view('livewire.manage.products.edit-product.colors');
    }
}
