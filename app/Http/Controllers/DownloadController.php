<?php

namespace App\Http\Controllers;

use App\Models\AlbumLocation;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    //
    public function descargarImagen($nickname, $photo_id)
    {

        Log::info($photo_id);

        try {

            $photo = Photo::findOrFail($photo_id);

            // Ruta de la imagen que deseas descargar
            $rutaImagen = $photo->large;

            // Verifica si la imagen existe
            if (Storage::disk('spaces')->exists($rutaImagen)) {
                // Obtiene la URL pública de la imagen
                $urlImagen = Storage::disk('spaces')->temporaryUrl($rutaImagen, now()->addMinutes(5));

                // Devuelve una respuesta para forzar la descarga de la imagen
                return response()->download($urlImagen);
                
            } else {
                // Maneja el caso en que la imagen no exista
                abort(404);
            }
        } catch (\Throwable $th) {

            Log::info('la imagen no existe');
        }
    }

}
