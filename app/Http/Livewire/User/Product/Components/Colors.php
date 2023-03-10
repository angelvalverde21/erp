<?php

namespace App\Http\Livewire\User\Product\Components;

use Livewire\Component;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ColorSize;


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
        $ColorSize = ColorSize::where('color_id',);
    }

    public function refreshColor(){
        $this->product = $this->product->fresh();
    }

    public function deleteColor(Color $colorPost){


        Log::debug($colorPost);

        //Borra los archivos de la carpeta del servidor
        Storage::delete([$colorPost->file_name]);

        //Borra los registros de la base de datos

        $color = Color::find($colorPost->id);

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

    }

    public function render()
    {

        return view('livewire.user.product.components.colors');
    }
}
