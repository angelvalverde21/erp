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

    public function uploadImageOption($nickname, Request $request){

        $existe = false;
        $store = User::where('nickname',$nickname)->first();

        $getOptions = $store->options;

        foreach ($getOptions as $getOption) { //getOptions de de la base de datos, hemos colocado 'get' a las variables para identificar que son las que vienen de la base de datos
            # code...
            if($request->name == $getOption->name){ //esto quiere decir que $name (de la plantilla) es igual a $getName (de la base de datos)
                $existe = true;
                $getOption->value = uploadImage($request, "users/logos"); //el value es el valor de la plantilla
                $getOption->save();
                break;
            }else{
                $existe = false;
            }
        }
        
        if(!$existe){
            //sino existe el campo entonces creamos
            $store->options()->create(
                [
                    'name' => $request->name,
                    'value' => uploadImage($request, "users/logos"),
                ],
            );
        }

    }
}
