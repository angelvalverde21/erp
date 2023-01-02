<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class HomeAccount extends Component
{
    public function render()
    {
        return view('livewire.account.home-account')->layout('layouts.manage');
    }
}
