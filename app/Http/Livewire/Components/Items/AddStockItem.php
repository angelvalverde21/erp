<?php

namespace App\Http\Livewire\Components\Items;

use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddStockItem extends Component
{
    public $item, $color;
    public $quantity = [];

    public function mount(Item $item)
    {
        $this->item = $item;

        // $color_size = ColorSize::find($item->content->color_size_id);
        $this->color = Color::find($item->content->color_id);
    }

    public function separarOrAsignar($color_size_id){

        Log::info($color_size_id);
        // Log::debug($this->order->id);
        // Log::debug($this->quantity[$value]);

        // $arrayValue = explode('-',$this->quantity[$value]);
        // $color_size_id = $arrayValue[0];
        // $qty = $arrayValue[1];

        // Log::debug($this->order->id);
        // Log::debug($this->quantity[$value]);

        //Obteniendo nombre de talla, archivo de imagen,  nombre de imagen
        //y el titulo del producto


        if($this->item->order->is_pay()){
            //como esta pagado asignamos Stock::VENDIDO
            $this->item->asignarStock($color_size_id);
        }else{
            //como no esta pagado cambiamos en la base de datos a Stock::SEPARADO
            $this->item->separarStock($color_size_id);
        }

        //$this->quantity_oversale[$value] = 0;
      
        $this->emit('closeModal');
        $this->emitTo('components.items.show-item-all','render');
        // $this->emitTo('manage.orders.edit-order.card-show-summary','render');
        // $this->emitTo('manage.orders.edit-order.card-show-invoice','render');

        //este emit necesita un listener
        $this->emit('creado');

    }


    public function render()
    
    {

        $color = $this->color;

        return view('livewire.components.items.add-stock-item', compact('color'));
    }
}
