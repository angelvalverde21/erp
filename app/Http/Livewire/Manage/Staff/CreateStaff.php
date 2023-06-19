<?php

namespace App\Http\Livewire\Manage\Staff;

use Livewire\Component;

class CreateStaff extends Component
{
    public function render()
    {
        return view('livewire.manage.staff.create-staff')->layout('layouts.manage');
    }
}
