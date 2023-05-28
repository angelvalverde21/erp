<?php

namespace App\Http\Livewire\Manage\Customers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowOrdersCustomers extends Component
{
    public $user, $store;

    public function mount(User $customer){
        $this->user = $customer;
        Log::info($this->user);

        $this->store = Request::get('store');
        Log::info('user: ' . $customer);

    }

    public function createOrder(){

        $order = new Order();

        $user = $this->user;

        $order->delivery_man_id = 1707;
        $order->payment_method_id = 5; //yape
        $order->delivery_method_id = 1; //delivery
        $order->store_id = $this->store->id;
        $order->seller_id = Auth::user()->id;
        $order->buyer_id = $user->id;
        
        $user->addresses;

        if($user->addresses->count()>0){

            foreach ($user->addresses as $address) {
                # code...
                $address_id = $address->id;
    
                break;
            }

            $order->address_id = $address_id; //el id de la direccion recien creada

            try {
    
                $order->saveOrFail();
    
                $order->Addstatus('creado',$this->current);
    
                Log::debug('Orden creada :' . $order);
        
                $this->emitTo('manage.orders.show-orders', 'render');
        
                //este emit necesita un listener
                $this->emit('creado');
    
            } catch (\Throwable $th) {
                //throw $th;
            }
    
        }

        return redirect()->route('manage.orders.edit', ['nickname' => $this->store->nickname, 'order' => $order->id]);

    }

    public function render()
    {

        $orders = $this->user->myOrders;

        Log::info($orders);

        return view('livewire.manage.customers.show-orders-customers', compact('orders'));
    }

}
