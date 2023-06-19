<?php

namespace App\Http\Livewire\Manage\Customers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowCustomers extends Component
{

    public $store;

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {

        $store = $this->store;

        $users = User::where('store_id',$this->store->id)->limit(50)->orderBy('id','desc')->get();

        return view('livewire.manage.customers.show-customers',compact('store','users'))->layout('layouts.manage');

    }
}
