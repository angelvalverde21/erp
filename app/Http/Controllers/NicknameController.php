<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class NicknameController extends Controller
{
    //

    public function __invoke($nickname)
    {
        $user = User::where('nickname',$nickname);
         
        //return $user->count();

        if($user->count()==1){

            $posts = Product::where('status','1')->orderBy('created_at','desc')->paginate(10);

            return view('livewire.web.home',compact('posts'))->layout('layouts.public');
        }else{
            
           return response()->view('errors.404', [], 404);
        }
    }
}
