<?php

namespace App\Http\Livewire\Components\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CardUpload extends Component
{

    // public $image, $field;

    public $user, $field;

    protected $listeners = [
        'render'=>'render',
        'deleteFileProfile' => 'deleteFileProfile',
        'refreshCard' => 'refreshCard',
    ];

    public function mount(User $user, $field = ''){
        $this->user = $user;
        $this->field = $field;
    }

    public function deleteFileProfile(User $user, $field){
       
        $user[$field] = null;
        $user->save();
        $this->user = $this->user->fresh();

  
        Log::info('refrescado y borrado');
    }

    public function refreshCard(){
       
        $this->user = $this->user->fresh();
        Log::info('subido y refrescado');

        Log::info('Los nuevos datos son: ');
        Log::info($this->user);
        
    }

    public function render()
    {
        $user = $this->user;
        $field = $this->field;

        // $this->delivery_methods = DeliveryMethod::userBy('name','asc')->get();
        // $this->paymentMethods = PaymentMethod::userBy('name','asc')->get();
        // $this->repartidores = User::repartidores();
        return view('livewire.components.profile.card-upload', compact('user','field'));
    }
}