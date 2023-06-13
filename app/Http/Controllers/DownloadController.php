<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    //
    public function descargarImagen($photo_id)
    {

        try {

            $photo = Photo::findOrFail($photo_id);

            // Ruta de la imagen que deseas descargar
            $rutaImagen = $photo->large;

            // Obtiene la URL pública de la imagen
            $urlImagen = Storage::disk('spaces')->url($rutaImagen);
            
            // Obtiene el nombre de archivo de la imagen
            $nombreArchivo = basename($rutaImagen);

            // Verifica si la imagen existe
            if (Storage::disk('spaces')->exists($rutaImagen)) {
                // Redirecciona a la URL de la imagen para iniciar la descarga
                return Response::redirectTo($urlImagen);
            } else {
                // Maneja el caso en que la imagen no exista
                abort(404);
            }
        } catch (\Throwable $th) {
            Log::info('la imagen no existe');
        }
    }
}
