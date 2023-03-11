<?php

namespace App\Http\Livewire\Manage\Productions;

use App\Models\Production;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class CreateProduction extends Component
{

    // private , $user;
    public $production, $store, $user;

    protected $rules = [
        'production.name' => 'required',
        'production.slug' => 'required|unique:productions,slug',
        'production.amount' => 'required'
    ];


    public function mount(){
    
        $this->store = Request::get('store');

        $this->user = Auth::user();

    }
    
    public function save(){

        //$rules = $this->rules;

        Log::info($this->production);
       
        //
        $this->validate($this->rules);

        Log::info('se paso el validate de production');
        
        
        $production = new Production();

        $production->name = $this->production['name'];
        $production->slug = $this->production['slug'];
        $production->amount = $this->production['amount'];
        
        $production->owner_id = $this->user->id;
        $production->store_id = $this->store->id;

        $production->short_link = substr(base64_encode(bcrypt(Str::slug($this->production['name']))),0,5);

        Log::info($production);

        //Guardo el producto
        $production->save();

        return redirect($this->store->nickname.'/manage/productions/'. $production->id);

    }

    public function updatedProductionName($value){
        //Log::debug(Str::slug($value));
        $this->production['slug'] = Str::slug($value);
    }


    public function render()
    {
        return view('livewire.manage.productions.create-production')->layout('layouts.manage');
    }
}
