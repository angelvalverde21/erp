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

            $file_path = Storage::path('albums/' . $original_name);

            //Recibo la imagen
            $image = Image::make($request->file('file'));

            //Redimenciono a Medium
            $image->resize(750, 500);

            //finalmente guardo la imagen
            $image->save($file_path_medium);

            //Redimenciono a Thumbnail
            $image->resize(300, 200);

            //finalmente guardo la imagen
            $image->save($file_path_thumb);



            // //Redimenciono a Large
            // $image->resize(1500, 1000);

            // //finalmente guardo la imagen
            // $image->save($file_path_large);



            //Preparo la direccion donde lo voy a guardar
            // $file_path = Storage::path('albums/' . $original_name);
            // // $file_path = storage_path() . "/app/public/temp/" . $original_name;

            // //Dejo un registro en el servidor porsiaca
            // Log::info($file_path);

            // Log::info('imagen redimensionada con INTERVENTION');
            // Log::info('Guardando imagen...');

            //finalmente guardo la imagen
            // $image->save(Storage::path('albums/' . $original_name));
            Log::info('Imagen guardada');

            //Subiendo el thumbnail, pero antes tenemos que rotarla
            //rotando el thumbnail

            $exif = exif_read_data($request->file('file'), 0, true);

            if (isset($exif) && $exif['IFD0']['Orientation'] == 8) {

                Log::info('La imagen esta rotada 270 grados');

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
            }


            //fin de rotacion

            Log::info('Guardando la imagen rotada (Thumb) en S3');

            // $image = Storage::disk('s3')->put('albums/thumb-' . $request->file('file')->hashName(), file_get_contents($file_path_thumb), 'public');
            //Ojo, aqui le indicamos a amazon el nombre del archivo, por lo que nos devolvera 1 si todo es correcto
            // $imageThumb = Storage::disk('s3')->put('albums/thumb/' . $name_thumb, file_get_contents($file_path_thumb), 'public');


            $imageThumb = Storage::disk('spaces')->put('albums/thumb/' . $name_thumb, file_get_contents($file_path_thumb), 'public');

            $imageMedium = Storage::disk('spaces')->put('albums/medium/' . $name_medium, file_get_contents($file_path_medium), 'public');

            // $image = Storage::disk('s3')->put('albums/thumb-' . $request->file('file')->hashName(), file_get_contents($file), 'public');

            //Eliminando el archivo creado para que no ocupe espacio en cpanel
            Log::info('Eliminando el archivo con Storage::delete');
            Log::info($file_path);

            Storage::delete($file_path_thumb);
            Storage::delete($file_path_medium);

            //Subiendo la imagen original
            Log::info('Subiendo la imagen original S3');
            //Subiendo la imagen original a amazon web services
            //como aqui no le damos el nombre del archivo, amazon lo crea solo y regresa el nombre si todo es correcto
            // $imageFull = Storage::disk('s3')->put('albums', $request->file('file'), 'standard_ia');
            $imageFull = Storage::disk('spaces')->putFile('albums', $request->file('file'), 'public');

            //crea un nuevo registro en la tabla images

            if ($imageThumb) {

                $value = [
                    'usage' => 'album',
                    'thumbnail' => 'albums/thumb/' . $name_thumb,
                    'medium' => 'albums/medium/' . $name_medium,
                    'name' => $imageFull,
                    'label' => $original_name,
                ];

                Log::info('Valor del vector a insertar');

                Log::info($value);

                $album_location->images()->create($value);
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
