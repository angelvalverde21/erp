<?php

namespace App\Http\Livewire\Manage\Profile;

use App\Models\ProfileStore;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ShowProfileWeb extends Component
{

    public $profile;

    protected $rules = [
        'profile.title' => 'required',
        'profile.ship_min' => 'required',
        // 'profile.address_id' => 'required',
        // 'profile.logo' => 'required',
    ];

    public function mount()
    {

        $this->store = Request::get('store');

        if ($this->store->profile) {

            Log::info($this->store->profile);
            // $this->profile['id'] = $this->store->profile->id;
            $this->profile['title'] = $this->store->profile->title;
            $this->profile['ship_min'] = $this->store->profile->ship_min;
            $this->profile['whatsapp'] = $this->store->profile->whatsapp;
            $this->profile['facebook'] = $this->store->profile->facebook;
            $this->profile['instagram'] = $this->store->profile->instagram;
            $this->profile['tiktok'] = $this->store->profile->tiktok;

        }else{
            Log::info("No hay datos");
        }
        
    }

    public function save(){

        if ($this->store->profile) {
            $profile = ProfileStore::find($this->store->profile->id);

        }else{
            //create new
            $profile = new ProfileStore();

            $profile->store_id = $this->store->id;

        }

        //Antes de asignar los valores validamos los campos que vienen del archivo blade.php
        $this->validate($this->rules);

        $profile->title    = $this->profile['title'];
        $profile->ship_min = $this->profile['ship_min'];
        $profile->whatsapp = $this->profile['whatsapp'];
        $profile->instagram = $this->profile['instagram'];
        $profile->facebook = $this->profile['facebook'];
        $profile->tiktok = $this->profile['tiktok'];
        
        $profile->save();

        $this->emit('actualizado');
        
    }

    public function render()
    {
        return view('livewire.manage.profile.show-profile-web')->layout('layouts.manage');
    }

}
