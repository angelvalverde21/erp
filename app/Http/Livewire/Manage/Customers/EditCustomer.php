<?php

namespace App\Http\Livewire\Manage\Customers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditCustomer extends Component
{

    protected $listeners = ['render' => 'render'];

    public function mount(User $customer){
        $this->store = Request::get('store');
        Log::info('user: ' . $customer);
        $this->user = $customer;
    }

    public function render()
    {

        $orders = Order::where('buyer_id', $this->user->id)->get();

        Log::info('x: ' . $orders);
        Log::info('x: ' . $this->user->id);

        return view('livewire.manage.customers.edit-customer',compact('orders'))->layout('layouts.manage');
    }  
}
