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

    public function uploadImageOption($nickname, Request $request, $user=null){

        $existe = false;

        if ($request->user_id > 0) {
            Log::info('modo user');
            $user = User::findOrFail($request->user_id);
            Log::info($user);
            $getOptions = $user->options;
        }else{
            Log::info('modo store');
            $store = User::where('nickname',$nickname)->first();
            $getOptions = $store->options;
        }

        Log::info($getOptions);

        foreach ($getOptions as $getOption) { //getOptions de de la base de datos, hemos colocado 'get' a las variables para identificar que son las que vienen de la base de datos
            # code...
            if($request->name == $getOption->name){ //esto quiere decir que $name (de la plantilla) es igual a $getName (de la base de datos)

                $existe = true;
                $getOption->value = uploadImage($request, "users/logos", 0, true); //el value es el valor de la plantilla, 0 quiere decir que no redimencione y true quiere decir que devuelve un link comleto
                $getOption->save();
                
                break;
            }else{
                $existe = false;
            }
        }
        
        if(!$existe){
            //sino existe el campo entonces creamos
            Log::info('ya existe');
            if ($user) {

                $user->options()->create(
                    [
                        'name' => $request->name,
                        'value' => uploadImage($request, "users/logos", 0, true),
                    ],
                );

            } else {
                $store->options()->create(
                    [
                        'name' => $request->name,
                        'value' => uploadImage($request, "users/logos", 0, true),
                    ],
                );
            }

        }else{
            Log::info('no existe');
        }

    }
}
