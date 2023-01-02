<?php

namespace App\Http\Livewire\Manage\Profile;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowProfileStore extends Component
{

    public function mount(){
        $this->store = Request::get('store');
    }

    public function render()
    {
        return view('livewire.manage.profile.show-profile-store')->layout('layouts.manage');
    }
}
