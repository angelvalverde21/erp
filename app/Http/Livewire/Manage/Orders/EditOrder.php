<?php

namespace App\Http\Livewire\Manage\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

class EditOrder extends Component
{

    protected $listeners = [
        'renderOrder' => 'render'
    ];

    public $order, $item, $repartidores, $delivery_methods, $payment_methods, $show_card_shipping, $current;
    public $store;
    public $user;

    protected $rules = [

        'order.delivery_man_id' => 'required',  //01
        'order.collect_method_id' => 'required', //02
        'order.payment_method_id' => 'required', //03
        // 'order.payment_list_method_id' => 'required',
        'order.delivery_method_id' => 'required',
        'order.observations_private' => 'required',
        'order.observations_public' => 'required',
        'order.observations_time' => 'required',
        
    ];

    public function mount(Order $order)
    {
        $this->store = Request::get('store');

        if($this->store->id == $order->store_id){
            $this->order = $order;
        }else{
            abort(403);
        }
        // $this->user = User::find($this->order->buyer_id);
    }

    //Como ya esta definida la podemos guardar
    public function saveObservations()
    {

        // $product->name = $this->item->content->price;
        // if($this->item)

        $this->order->save();

        //$this->emitTo('user.sales.edit-sale.show-summary', 'render');
        $this->emit('actualizado');
        $this->emitTo('manage.orders.edit-order.card-warning-alerts','render');

        //$this->emitSelf('render');
    }

    public function saveSelected()
    {
        $this->order->save();
        $this->order = $this->order->fresh();
    }

    // public function changePaymentMethod()
    // {
    //     $this->order->save();
    //     $this->order = $this->order->fresh();
    // }

    // public function selectPaymentMethod(){

    // }

    // public function test()
    // {
    //     $this->emit('creado');
    //     $this->dispatchBrowserEvent('cerrar-modal', ['modalID' => '#editItem']);
    // }

    public function reactivarOrden(){
        $this->order->reactivate();
        $this->emitTo('manage.orders.edit-order.card-status-iconos', 'render');
        $this->emitTo('components.items.show-item-all', 'render');
        $this->order = $this->order->fresh();
    }

    public function render()
    {
        //$this->items = Item::where('order_id', $this->order->id)->get();
        //$payment_methods = PaymentMethod::all()->orderBy('name','desc')->get(); OJO, este codigo no funcion
        //el metodo all() solo funcion son sortByDesc en todo caso si se desea usar all() se podria usar
        //$delivery_method = New DeliveryMethod()
        //y recien ahi aplicarle ::all()->orderBy('name','desc')->get();
        //quedaria como $delivery_methods = $delivery_method::all()->orderBy('name','desc')->get();

        $order = $this->order;
        
        // Log::info('inicio de status');
        
        // Log::info($order->verify('pago_confirmado'));
        
        // Log::info('fin de status');

        return view('livewire.manage.orders.edit-order', compact('order'))->layout('layouts.manage');
    }

}
