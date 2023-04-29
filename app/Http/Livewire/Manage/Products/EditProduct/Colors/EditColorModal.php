<?php

namespace App\Http\Livewire\Manage\Products\EditProduct\Colors;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditColorModal extends Component
{

    protected $listeners = [
        'render'=>'render',
        'refreshColor'=>'refreshColor',
    ]; //cuando laravel escuche este evento buscara un metodo con el mismo nombre
    
    protected $rules = [
        'color.label'=>'required',
    ];

    public $color;
    public $product;


    public function mount(Color $color, $store){


        $this->color = $color; 

        $this->store = $store;

        // $this->user = Auth::user();
        $this->product = Product::find($color->product_id);
    
        
        // $this->category_id = $album->subcategory->category->id;
        // $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
    }

    public function save(){

        //$rules = $this->rules;
        //
        $this->validate($this->rules);

        
        $this->color->save();

        $this->emit('actualizado');

    }

    public function refreshColor(){
        $this->product = $this->product->fresh();
    }

    public function deleteVarianteColor(Image $image){

        $image->delete();
        
        $this->product = $this->product->fresh();

        $this->emit('eliminado');
    }

    public function render()
    {
        $color = $this->color; 


        return view('livewire.manage.products.edit-product.colors.edit-color-modal', compact('color'));
    }
}
