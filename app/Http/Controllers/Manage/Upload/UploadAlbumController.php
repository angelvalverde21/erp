<?php

namespace App\Http\Controllers\Manage\Upload;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumLocation;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;


class UploadAlbumController extends Controller
{
    //
    public function uploadAlbum($nickname, Album $album, Location $location, Request $request)
    {
        try {

            $album_location = AlbumLocation::where('album_id', $album->id)->where('location_id', $location->id)->first();

            $request->validate([
                'file' => 'required|image|max:20480'  //10 megas
            ]);

            $name_thumb = md5(time() . 'thumb' . Str::random(10)) . ".jpg";
            $name_medium = md5(time() . 'medium' . Str::random(10)) . ".jpg";
            // $name_large = md5(time() . 'large' . Str::random(10)).".jpg";  

            //crea los directorios respectivos

            if (!file_exists(Storage::path('albums/medium'))) {
                mkdir(Storage::path('albums/medium'), 0755, true);
            }

            // mkdir(Storage::path('albums'), 0755);
            // mkdir(Storage::path('albums/thumb'), 0755);
            // mkdir(Storage::path('albums/medium'), 0755);
            // mkdir(Storage::path('albums/large'), 0755);

            //Ojo como se coje la misma imagen para reducir el tamano, empezamos desde el mas grande al mas pequeno

            $file_path_medium = Storage::path('albums/medium/' . $name_medium);

            $file_path_thumb = Storage::path('albums/thumb/' . $name_thumb);

            // $file_path_large = Storage::path('albums/large/' . $name_large);

            $original_name = $request->file('file')->getClientOriginalName();

            //Hasta aqui ya tenemos el nombre de los 3 archivos que subiremos al servidor respectivo.

            // $file_path = Storage::path('albums/' . $original_name);

            //Recibo la imagen original
            $image = Image::make($request->file('file'));


            //Extrayendo la informacion "exif" de la imagen 
            $exif = exif_read_data($request->file('file'), 0, true);


            if (isset($exif)) {

                if (isset($exif['IFD0']['Orientation']) == 8) {

                    //se debe rotar la imagen
                    Log::info('La imagen esta rotada 270 grados');

                    //Redimenciono a Medium
                    $image->resize(750, 500);

                    //finalmente guardo la imagen
                    $image->save($file_path_medium);

                    Log::info('Imagen Medium guardada');

                    //Redimenciono a Thumbnail
                    $image->resize(300, 200);

                    //finalmente guardo la imagen
                    $image->save($file_path_thumb);

                    Log::info('Imagen Thumb guardada');

                    //Subiendo el thumbnail, pero antes tenemos que rotarla
                    //rotando el thumbnail


                    //"si es 8, la imagen esta rotada 270";

                    //Imagen inicial horizontal
                    // $imageNew = $file_path;
                    //Destino de la nueva imagen vertical

                    //Definimos los grados de rotacion

                    $degrees = 90;

                    //Creamos una nueva imagen a partir del fichero inicial
                    $sourceThumb = imagecreatefromjpeg($file_path_thumb);
                    $sourceMedium = imagecreatefromjpeg($file_path_medium);

                    //Rotamos la imagen 90 grados
                    Log::info('Rotando imagen');
                    $rotateThumb = imagerotate($sourceThumb, $degrees, 0);
                    $rotateMedium = imagerotate($sourceMedium, $degrees, 0);

                    //Creamos el archivo jpg vertical

                    Log::info('Creando la imagen con imagenjpg()');
                    imagejpeg($rotateThumb, $file_path_thumb, '90');
                    imagejpeg($rotateMedium, $file_path_medium, '90');
                    
                } else {
                    # code...
                    //La imagen no debe ser rotada y debemos corregir las dimensiones

                    //Redimenciono a Medium
                    $image->resize(500, 750);

                    //finalmente guardo la imagen
                    $image->save($file_path_medium);

                    Log::info('Imagen Medium guardada');

                    //Redimenciono a Thumbnail
                    $image->resize(200, 300);

                    //finalmente guardo la imagen
                    $image->save($file_path_thumb);

                    Log::info('Imagen Thumb guardada');
                    
                }
            }


            //fin de rotacion

            Log::info('Guardando la imagen rotada (Thumb) en S3');

            // $image = Storage::disk('s3')->put('albums/thumb-' . $request->file('file')->hashName(), file_get_contents($file_path_thumb), 'public');
            //Ojo, aqui le indicamos a amazon el nombre del archivo, por lo que nos devolvera 1 si todo es correcto
            // $imageThumb = Storage::disk('s3')->put('albums/thumb/' . $name_thumb, file_get_contents($file_path_thumb), 'public');

            //ojo spaces es de digital ocean pero usa la misma configuracion de s3
            $imageThumb = Storage::disk('spaces')->put('albums/thumb/' . $name_thumb, file_get_contents($file_path_thumb), 'public');

            $imageMedium = Storage::disk('spaces')->put('albums/medium/' . $name_medium, file_get_contents($file_path_medium), 'public');

            // $image = Storage::disk('s3')->put('albums/thumb-' . $request->file('file')->hashName(), file_get_contents($file), 'public');

            //Eliminando el archivo creado para que no ocupe espacio en cpanel
            Log::info('Eliminando el archivo con Storage::delete');
            Log::info($file_path);

            Storage::delete('albums/thumb/' . $name_thumb);
            Storage::delete('albums/medium/' . $name_medium);

            //Subiendo la imagen original
            Log::info('Subiendo la imagen original S3');
            //Subiendo la imagen original a amazon web services
            //como aqui no le damos el nombre del archivo, amazon lo crea solo y regresa el nombre si todo es correcto
            // $imageFull = Storage::disk('s3')->put('albums', $request->file('file'), 'standard_ia');
            $imageFull = Storage::disk('spaces')->putFile('albums/large', $request->file('file'), 'public');

            //crea un nuevo registro en la tabla images

            if ($imageThumb) {

                $value = [
                    'thumbnail' => 'albums/thumb/' . $name_thumb,
                    'medium' => 'albums/medium/' . $name_medium,
                    'large' => $imageFull,
                    'name' => $original_name,
                    'exif' => $exif,
                    'capture_date' => $exif['IFD0']['DateTime'],
                    'brand' => $exif['IFD0']['Make'],
                    'model' => $exif['IFD0']['Model'],
                ];

                Log::info('Valor del vector a insertar');

                Log::info($value);

                $album_location->photos()->create($value);
            } else {
                Log::info('el thubm no es valido');
            }


            // Storage::delete($file_path);

        } catch (\Throwable $th) {

            Log::info('No se paso la validacion para subir la foto');
            // Log::info($th);
            Log::info($request);
            Log::info($th);
        }
    }
}
