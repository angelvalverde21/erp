<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function uploadFile(User $user, $field, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);
        $url = Storage::put('stores/logos', $request->file('file'));
        $user[$field] = $url;
        $user->save();
        //Log::debug($url);
        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    // public function uploadLogoGeneral(User $user, Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|image|max:10240'  //10 megas
    //     ]);
    //     $url = Storage::put('public/users', $request->file('file'));
    //     $user->upload_logo_general = $url;
    //     $user->save();

    //     //Log::debug($url);
    //     //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    // }

    // public function uploadLogoInvoice(User $user, Request $request)
    // {

    //     $request->validate([
    //         'file' => 'required|image|max:10240'  //10 megas
    //     ]);
    //     $url = Storage::put('public/users', $request->file('file'));
    //     $user->upload_logo_invoice = $url;
    //     $user->save();

    //     //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    // }

    
    // public function profilePhotoPath(User $user, Request $request)
    // {

    //     $request->validate([
    //         'file' => 'required|image|max:10240'  //10 megas
    //     ]);
    //     $url = Storage::put('public/users', $request->file('file'));
    //     $user->profile_photo_path = $url;
    //     $user->save();

    //     //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    // }
}
