<?php

namespace App\Http\Livewire\User\Sales\EditSale;

use App\Models\User;
use Livewire\Component;

class CardUserDetails extends Component
{
    public function mount(User $user){
        $this->user = $user;
    }

    public function render()
    {
        $user = $this->user;
        return view('livewire.user.sales.edit-sale.card-user-details', compact('user'));
    }
}
