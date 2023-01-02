<?php

namespace App\Http\Livewire\Manage\Profile;

use Livewire\Component;

class ShowProfileUser extends Component
{
    public function render()
    {
        return view('livewire.manage.profile.show-profile-user')->layout('layouts.manage');
    }
}
