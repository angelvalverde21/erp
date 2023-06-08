<?php

namespace App\Http\Livewire\Components\Users;

use Livewire\Component;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class EditUser extends Component
{

    public $store, $user;

    protected $listeners = ['render' => 'render'];

    public function mount(User $user){
        $this->store = Request::get('store');
        Log::info('user: ' . $user);
        $this->user = $user;
    }

    public function render()
    {
        // es para mostrar en la pagina del cliente si tiene ordenes o no
        $orders = Order::where('buyer_id', $this->user->id)->get();

        // Log::info('x: ' . $orders);
        // Log::info('x: ' . $this->user->id);

        return view('livewire.components.users.edit-user',compact('orders'))->layout('layouts.manage'); //como este sera una pagina independiente se necesita el layout
    }  

}
