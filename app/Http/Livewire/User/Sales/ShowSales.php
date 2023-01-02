<?php

namespace App\Http\Livewire\User\Sales;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowSales extends Component
{
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $user = Auth::user();

        $sales = Order::where('seller_id',$user->id)->with(['buyer','seller','delivery_man'])->get();

        return view('livewire.user.sales.show-sales',compact('sales'))->layout('layouts.user');
    }
}
