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
    public $inputsAdd = [];
    public $inputsTotal = [];
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

    function updatedInputsAdd(){

        $keys =  array_keys($this->inputsAdd);
        $i = 0; //mas abajo se encuentra en i++

        foreach ($this->inputsAdd as $item) {

            $colorSize = ColorSize::findOrFail($keys[$i]);
            $stockReal = $colorSize->stocks()->count();

            if(isset($this->inputsAdd[$keys[$i]]['quantity'])){
                // unset($this->inputs[$keys[$i]]['quantity']);
                $quantity = $this->inputsAdd[$keys[$i]]['quantity'];
                $this->inputsTotal[$keys[$i]]['quantity'] =  $stockReal + intval($quantity);
            }

            // $quantity_add = $this->inputs[$keys[$i]]['quantity_add'];
            // $quantity = $this->inputs[$keys[$i]]['quantity'];

            $i++;
        }

    }

    function updatedInputsTotal(){
        $keys =  array_keys($this->inputsTotal);
        $i = 0; //mas abajo se encuentra en i++

        foreach ($this->inputsTotal as $item) {

            $colorSize = ColorSize::findOrFail($keys[$i]);
            $stockReal = $colorSize->stocks()->count();

            if(isset($this->inputsTotal[$keys[$i]]['quantity'])){
                // unset($this->inputs[$keys[$i]]['quantity']);
                $quantity = $this->inputsTotal[$keys[$i]]['quantity'];
                $this->inputsAdd[$keys[$i]]['quantity'] =  intval($quantity) - $stockReal;
            }

            // $quantity_add = $this->inputs[$keys[$i]]['quantity_add'];
            // $quantity = $this->inputs[$keys[$i]]['quantity'];

            $i++;
        }
    }

    function guardarStock()
    {

        Log::debug($this->inputsAdd);
        $keys =  array_keys($this->inputsAdd);
        $i = 0; //mas abajo se encuentra en i++

        foreach ($this->inputsAdd as $item) {

            //Esta es la cantidad que viene de los inputs

            $quantity = $this->inputsTotal[$keys[$i]]['quantity'];

            
            if ($quantity >= 0) {

                $colorSize = ColorSize::findOrFail($keys[$i]);

                $colorSize->updateAlmacen($quantity);

            }else{
                Log::info('el valor ingresado debe ser mayor a cero');
                
            }

            $i++;
        }

        foreach ($this->color->sizes as $size) {
            $this->inputsAdd[$size->pivot->id]['quantity'] = "";
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
