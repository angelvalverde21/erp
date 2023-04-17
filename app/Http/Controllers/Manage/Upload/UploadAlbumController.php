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

            $image = Image::make($request->file('file'));

            $image->resize(1124, 750);

            $file = storage_path(). "\app\public\\temp\\".$request->file('file')->getClientOriginalName();

            Log::info($file);

            $image->save($file);

            //Subiendo el thumbnail, pero antes tenemos que rotarla

            $exif = exif_read_data($request->file('file'), 0, true);
		
            if($exif['IFD0']['Orientation']==8){
                
                //"si es 8, la imagen esta rotada 270";
    
                //Imagen inicial horizontal
                $imageNew = $file;
                //Destino de la nueva imagen vertical
                 
                //Definimos los grados de rotacion
                $degrees = 90;
                 
                //Creamos una nueva imagen a partir del fichero inicial
                $source = imagecreatefromjpeg($imageNew);
                 
                //Rotamos la imagen 90 grados
                $rotate = imagerotate($source, $degrees, 0);
                 
                //Creamos el archivo jpg vertical
                imagejpeg($rotate, $file,'90');

            }

            //fin de rotacion
            
            $image = Storage::disk('s3')->put('albums/thumb-'.$request->file('file')->hashName(),file_get_contents($file), 'public');

            //Eliminando el archivo creado para que no ocupe espacio en cpanel
            Log::info('Eliminando el archivo con Storage::delete');
            Log::info($file);
            Storage::delete($file);

            //Subiendo la imagen original
            $image = Storage::disk('s3')->put('albums',$request->file('file'), 'public');
            
            $album->images()->create([ //crea un nuevo registro en la tabla images
                'usage' => 'album',
                'name' => $image,
            ]);


        } catch (\Throwable $th) {

            Log::info('No se paso la validacion para subir la foto');
            // Log::info($th);
            Log::info($request);
        }
    }

}
