<?php

namespace App\Http\Livewire\User\Profile;

use App\Models\User;
use Livewire\Component;

class CardUpload extends Component
{

    protected $listeners = [
        'render'=>'render',
        'deleteFileProfile' => 'deleteFileProfile',
        'refreshCard' => 'refreshCard',
    ];

    public function mount(User $user){
        $this->user = $user;
    }

    public function deleteFileProfile(User $user, $field){
       
        $user[$field] = null;
        $user->save();
        $this->user = $this->user->fresh();

    }

    public function refreshCard(){
       
        $this->user = $this->user->fresh();
        
    }

    public function render()
    {
        $user = $this->user;
        // $this->delivery_methods = DeliveryMethod::userBy('name','asc')->get();
        // $this->paymentMethods = PaymentMethod::userBy('name','asc')->get();
        // $this->repartidores = User::repartidores();
        return view('livewire.user.profile.card-upload', compact('user'));
    }
}
