<?php

namespace App\Http\Livewire\User\Sales;

use App\Models\DeliveryMethod;
use App\Models\Item;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditSale extends Component
{


    protected $listeners = [
        'render' => 'render'
    ];

    public $order, $item, $repartidores, $delivery_methods, $payment_methods, $show_card_shipping;

    protected $rules = [

        'order.delivery_method_id' => 'required',
        'order.observations_private' => 'required',
        'order.observations_public' => 'required',
        'order.observations_time' => 'required',
        
    ];

    public function mount(Order $sale)
    {

        $this->order = $sale;
        $this->user = User::find($this->order->buyer_id);
    }


    //Como ya esta definida la podemos guardar
    public function saveObservations()
    {

        // $product->name = $this->item->content->price;

        // if($this->item)

        $this->order->save();

        //$this->emitTo('user.sales.edit-sale.show-summary', 'render');
        $this->emit('actualizado');


        //$this->emitSelf('render');
    }

    public function changeDeliveryMethod()
    {
        $this->order->save();
        $this->order = $this->order->fresh();
    }

    public function test()
    {

        $this->emit('creado');
        $this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#editItem']);
    }
    public function render()
    {
        //$this->items = Item::where('order_id', $this->order->id)->get();
        //$payment_methods = PaymentMethod::all()->orderBy('name','desc')->get(); OJO, este codigo no funcion
        //el metodo all() solo funcion son sortByDesc en todo caso si se desea usar all() se podria usar
        //$delivery_method = New DeliveryMethod()
        //y recien ahi aplicarle ::all()->orderBy('name','desc')->get();
        //quedaria como $delivery_methods = $delivery_method::all()->orderBy('name','desc')->get();
        $this->delivery_methods = DeliveryMethod::orderBy('name', 'asc')->get();


        $order = $this->order;

        return view('livewire.user.sales.edit-sale', compact('order'))->layout('layouts.user');
    }
}
