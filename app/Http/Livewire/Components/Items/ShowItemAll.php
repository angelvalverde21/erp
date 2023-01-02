<?php

namespace App\Http\Livewire\Components\Items;

use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowItemAll extends Component
{

    public $stockReal;

    protected $listeners = [
        'render' => 'render'
    ];

    protected $rules = [
        'item.description' => 'required',
        'item.content.talla' => 'required',
        'item.content.price' => 'required',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    //Aqui definimos la variable $item
    public function editItem(Item $item)
    {
        Log::debug($item);
        $this->item = $item;
    }

    //Como ya esta definida la podemos guardar
    public function saveEditItem()
    {

        // $product->name = $this->item->content->price;

        // if($this->item)

        //$this->validate($this->rules);

        $this->item->save();

        $this->emitTo('manage.orders.edit-order.card-show-summary','render');
        $this->emit('actualizado');
        //$this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#editItem']);

        //$this->emitSelf('render');
    }

    public function deleteItem(Item $item)
    {

        Log::debug($item);

        //Borra los archivos de la carpeta del servidor
        //Storage::delete([$colorPost->file_name]);

        //Borra los registros de la base de datos

        actualizarStock($item->id,"devolver");

        $item->delete();
        $this->emitTo('user.sales.edit-sale.show-summary', 'render');
        //Each porque eliminara una coleccion de sizes
        //$color->sizes->each->delete();

        $this->order = $this->order->fresh();

        $this->emit('eliminado');
    }

    public function corregirStock(Item $item){
        Log::info($item);

        if($item->quantity_oversale > 0 && ( stockColorSizeId($item->content->color_size_id) >= $item->quantity_oversale ) ){

            $item->quantity = $item->quantity_oversale;
            $item->quantity_oversale = 0;

            $item->save();

            actualizarStock($item->id,'separar');

            $this->order = $this->order->fresh();
        }
    }

    public function render()
    {

        $items =  Item::where('order_id', $this->order->id)->get();

        return view('livewire.components.items.show-item-all', compact('items'));
    }
}
