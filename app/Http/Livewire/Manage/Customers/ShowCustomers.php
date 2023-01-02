<?php

namespace App\Http\Livewire\Manage\Customers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowCustomers extends Component
{


    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {

        $store = $this->store;

        $customers = User::where('store_id',$this->store->id)->get();

        return view('livewire.manage.customers.show-customers',compact('store','customers'))->layout('layouts.manage');

    }
}
