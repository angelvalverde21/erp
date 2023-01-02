<?php

namespace App\Http\Livewire\Manage\Products\EditProduct;

use App\Models\Color;
use Livewire\Component;
use App\Models\ColorSize as Pivot;
use App\Models\ColorSize;
use Illuminate\Support\Facades\Log;


class StockColorSize extends Component
{
    
    public $color;
    public $pivot_quantity;
    public $inputs = [];
    public $item = [];



    public function mount(Color $color)
    {

        $this->color = $color;

        foreach ($this->color->sizes as $size) {
            # code...
            // array_push($this->inputs,[
            //     $size->pivot->id => [
            //         'quantity' => $size->pivot->quantity
            //     ]
            // ]);
            //$this->inputs[$size->pivot->id]['quantity'] = $size->pivot->quantity;
        }

        Log::debug($this->inputs);
    }

    // function updatedInputs($value){
    //     Log::debug($value);
    // }

    function guardarStock()
    {

        Log::debug($this->inputs);

        $keys =  array_keys($this->inputs);

        $i = 0;

        foreach ($this->inputs as $item) {
            if($this->inputs[$keys[$i]]['quantity']){
                ColorSize::where('id', '=', $keys[$i])->update(array('quantity' => $this->inputs[$keys[$i]]['quantity'])); 
            }
            $i++;
        }

        foreach ($this->color->sizes as $size) {
            $this->inputs[$size->pivot->id]['quantity'] = "";
        }

        $this->color = $this->color->fresh();

        $this->emit('refreshColor');
        //$this->emit('refreshProductEdit');

        //$this->emitTo('user.product.edit-product','render');

    }
    
    public function render()
    {
        return view('livewire.manage.products.edit-product.stock-color-size');
    }

}
