<?php

namespace App\Http\Controllers\Manage\Upload;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;


class UploadAlbumController extends Controller
{
    //
    public function uploadAlbum($nickname, Album $album, Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|image|max:20480'  //10 megas
            ]);

            //Recibo la imagen
            $image = Image::make($request->file('file'));

            //la redimenciono
            $image->resize(750, 500);

            $original_name = $request->file('file')->getClientOriginalName();

            //Preparo la url donde lo voy a guardar
            $file = storage_path() . "/app/public/temp/" . $original_name;

            //Dejo un registro en el servidor porsiaca
            Log::info($file);

            Log::info('imagen redimensionada con INTERVENTION');
            Log::info('Guardando imagen...');

            //finalmente guardo la imagen
            $image->save($file);
            Log::info('Imagen guarda');

            //Subiendo el thumbnail, pero antes tenemos que rotarla

            $exif = exif_read_data($request->file('file'), 0, true);

            if ($exif['IFD0']['Orientation'] == 8) {

                Log::info('La imagen esta rotada 270 grados');

                //"si es 8, la imagen esta rotada 270";

                //Imagen inicial horizontal
                $imageNew = $file;
                //Destino de la nueva imagen vertical

                //Definimos los grados de rotacion
                $degrees = 90;

                //Creamos una nueva imagen a partir del fichero inicial
                $source = imagecreatefromjpeg($imageNew);

                //Rotamos la imagen 90 grados
                Log::info('Rotando imagen');
                $rotate = imagerotate($source, $degrees, 0);

                //Creamos el archivo jpg vertical

                Log::info('Creando la imagen con imagenjpg()');
                imagejpeg($rotate, $file, '90');
            }

            //fin de rotacion

            Log::info('Guardando la imagen rotada (Thumb) en S3');

            $image = Storage::disk('s3')->put('albums/thumb-' . $request->file('file')->hashName(), file_get_contents($file), 'public');

            //Eliminando el archivo creado para que no ocupe espacio en cpanel
            Log::info('Eliminando el archivo con Storage::delete');
            Log::info($file);

            // Storage::delete($file);

            //Subiendo la imagen original
            Log::info('Subiendo la imagen original S3');
            //Subiendo la imagen original a amazon web services
            $image = Storage::disk('s3')->put('albums', $request->file('file'), 'public');

            //crea un nuevo registro en la tabla images

            $value = [
                'usage' => 'album',
                'name' => $image,
                'label' => $original_name,
            ];

            Log::info('Valor del vector a insertar');

            Log::info($value);

            $album->images()->create($value);

            // Storage::delete($file);

        } catch (\Throwable $th) {

            Log::info('No se paso la validacion para subir la foto');
            // Log::info($th);
            Log::info($request);
            Log::info($th);

        }
    }
}
