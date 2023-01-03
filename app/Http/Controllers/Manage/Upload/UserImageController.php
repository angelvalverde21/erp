<?php

namespace App\Http\Controllers\Manage\Upload;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{
    //
    public function uploadCarousel($nickname, Request $request)
    {

        $user = User::where('nickname',$nickname)->first();

        Log::info($user);

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = Storage::put('web/carousel', $request->file('file'));

        // $user->images()->create([
        //     'name' => $url,
        //     'usage' => $usage
        // ]);


        $carousel = new Carousel();

        $carousel->store_id = $user->id;

        $carousel->image = $url;
        $carousel->type = $request->type;

        $carousel->save();

    }
}
