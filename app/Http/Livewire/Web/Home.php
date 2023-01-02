<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Home extends Component
{

    public function mount($nickname){

        $this->user = User::where('nickname',$nickname)->get();         
        //return $user->count();

    }

    public function render()
    {
       
        if($this->user->count()==1){

            $posts = Product::where('owner_id','10')->orderBy('created_at','asc')->paginate(100);

            return view('livewire.web.home',compact('posts'))->layout('layouts.public');
        }else{
            
           return response()->view('errors.404', [], 404);
        }
    }
}
