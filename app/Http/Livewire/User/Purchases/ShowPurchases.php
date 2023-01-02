<?php

namespace App\Http\Livewire\User\Purchases;

use App\Models\Order;
use Livewire\Component;

class ShowPurchases extends Component
{
    public function render()
    {

        $user = auth()->user();

        $purchases = Order::orderBy('id', 'desc')->where('buyer_id', $user->id)
                ->paginate(10);

        //return view('livewire.user.product.show-products', compact('posts'))->layout('layouts.user');

        return view('livewire.user.purchases.show-purchases', compact('purchases'))->layout('layouts.user');
    }
}
