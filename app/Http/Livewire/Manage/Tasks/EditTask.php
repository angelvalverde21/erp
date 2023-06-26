<?php

namespace App\Http\Livewire\Manage\Tasks;

use Livewire\Component;

class EditTask extends Component
{
    public function render()
    {
        return view('livewire.manage.tasks.edit-task')->layout('layouts.manage');
    }
}
