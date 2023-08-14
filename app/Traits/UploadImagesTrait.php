<?php

namespace App\Traits;

use Carbon\Carbon; //se usa para las fechas
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

function uploadImage($request, $dir = "", $size = 0, $link = false)
{
    $originalName = $request->file('file')->getClientOriginalName();

    //extraemos la extencio
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);

    //Creando un nombre
    $name = md5(time() . $originalName . $dir . Str::random(10)) . '.' . $extension;

    //Estableciendo el directorio donde se guardara la imagen
    $path = Storage::path($dir);

    //sino existe el directorio entonces lo creamos
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }

    //establecemos la ruta del nuevo archivo
    $file_path = Storage::path($dir . '/' . $name);


    // // Log::info('up-1');

    // // Log::info('up-3');
    // $nameEncrypt = md5(
    //     bcrypt(
    //         $originalName . bcrypt(time())
    //     )
    // );

    // // Log::info('up-4');
    // $guardarEn = storage_path(). "/app/public/" .$dir . "/" . $nameEncrypt . "." . $extension;
    // $returnName = $dir . "/" . $nameEncrypt . "." . $extension;
    // Log::info($guardarEn);

    // // Log::info('up-5');

    // $image = Image::make($request->file('file'));

    // $image->resize(750, null, function($constraint) {
    //     $constraint->aspectRatio();
    // });

    $image = Image::make($request->file('file')); //OJO Image::make es de intervention no es del Model Imagen

    if ($size > 0) {
        //Creamos la imagen segun el tamano deseado
        $image->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    } else {
        //Creamos la imagen original
        $image->resize('100%', '100%');
    }

    $image->save($file_path);

    // $image->resize(350, null, function($constraint) {
    //     $constraint->aspectRatio();
    // });

    // //finalmente guardo la imagen
    // $image->save($file_path_thumb);

    // Log::info('up-6');

    // //Recibo la imagen
    // $image = Image::make($request->file('file'));

    // //Redimenciono a Medium
    // $image->resize(750, 500);

    // //finalmente guardo la imagen
    // $image->save($file_path_medium);

    // //Redimenciono a Thumbnail
    // $image->resize(300, 200);

    // //finalmente guardo la imagen
    // $image->save($file_path_thumb);

    if($link){
        return asset(Storage::url($dir . '/' . $name));
    }else{
        return $dir . '/' . $name;
    }


}