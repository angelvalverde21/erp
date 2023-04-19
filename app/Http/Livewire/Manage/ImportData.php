<?php

namespace App\Http\Livewire\Manage;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class ImportData extends Component
{

    public $old_users;

    public function mount()
    {

                
    }

    public function getOldUser()
    {
        //DB::table('categories')->delete();
        $json = File::get("database/import_old_db/ayv_usuarios.json");

        $this->old_users = json_decode($json);

        // foreach ($old_users as $user) {
        //     echo "<pre>Se insertó el dato de: " .$user->NOMBRE . "</pre>";
        //     flush();
        // }
    }

    public function render()
    {
        $old_users = $this->old_users;

        return view('livewire.manage.import-data',compact('old_users'))->layout('layouts.manage');
    }
}
