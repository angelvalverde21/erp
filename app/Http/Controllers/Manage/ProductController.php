<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ProductController extends Controller
{
    //Funcion para cargar las imagenes de los productis (ojo NO los colores)
    public function uploadImages($nickname, Product $product, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $url = Storage::put('products', $request->file('file'));
        $url = uploadImage($request, "products");
        $urlThumb = uploadImage($request, "products/thumb", 360);
        $urlMedium = uploadImage($request, "products/medium", 750);
        $urlLarge = uploadImage($request, "products/large", 1080);
        // Log::info('inicio de imagen');

        // Log::info($url);

        // Log::info('fin de imagen');

        $product->images()->create([
            'name' => $url,
            'thumbnail' => $urlThumb,
            'medium' => $urlMedium,
            'large' => $urlLarge,
        ]);


        //Ojo ya no es necesario ingresar la relacion imageable_id e imageable_type
    }

    public function editImage($nickname, Image $image, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $image->name = Storage::put('products', $request->file('file'));
        $image->name = uploadImage($request, "products");

        $image->save();

        Log::debug($image);
        Log::debug($request);
    }

    public function editColor($nickname, Color $color, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $color->image = uploadImage($request, "products/colors");

        $color->save();

        Log::debug($color);
        Log::debug($request);
    }

    public function uploadColors($nickname, Product $product, Request $request)
    {

        Log::info('el producto recibido es: ');

        Log::info($product);


        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        $url = uploadImage($request, "products/colors");
        $urlThumb = uploadImage($request, "products/colors/thumb", 360);
        $urlMedium = uploadImage($request, "products/colors/medium", 750);
        $urlLarge = uploadImage($request, "products/colors/large", 1080);

        Log::info('creando los colores e imagenes');

        //Crea el color
        $color = $product->colors()->create(
            [
                'image' => $url,
                'name' => $nickname,
                'quantity' => '0'
            ]
        );

        //Crea la primera imagen para el color
        $color->images()->create(
            [
                'name' => $url,
                'thumbnail' => $urlThumb,
                'medium' => $urlMedium,
                'large' => $urlLarge,
            ]
        );


        //Crea las tallas para el color creado

        $sizes = Size::where('product_id', $color->product_id)->get();

        foreach ($sizes as $size) {

            //Agregado datos a la tabla pivote
            ColorSize::create(
                [
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'quantity' => '0'
                ]
            );
        }

        Log::info('se creo la sizes para el color->product_id: ' . $color->product_id);
    }

    //Variantes del color
    public function uploadVariantsColor($nickname, Color $color, Request $request)
    {

        $request->validate([
            'file' => 'required|image|max:10240'  //10 megas
        ]);

        // $url = Storage::put('colors', $request->file('file'));
        $url = uploadImage($request, "products/colors");
        $urlThumb = uploadImage($request, "products/colors/thumb", 360);
        $urlMedium = uploadImage($request, "products/colors/medium", 750);
        $urlLarge = uploadImage($request, "products/colors/large", 1080);
        
        //Crea el stock en caso no haya tallas
        $color->images()->create(
            [
                'name' => $url,
                'usage' => 'color',
                'thumbnail' => $urlThumb,
                'medium' => $urlMedium,
                'large' => $urlLarge,
            ]
        );

        // $sizes = Size::where('product_id',$color->product_id)->get();

        // foreach ($sizes as $size) {

        //     //Agregado datos a la tabla pivote
        //     ColorSize::create(
        //         [
        //             'color_id' => $color->id,
        //             'size_id' => $size->id,
        //             'quantity' => '0'
        //         ]
        //     );
        // }
    }

    public function downLoadColor($nickname, Product $color){
        
    }


    public function downLoadZipProduct($nickname, Product $product){

        $colors = $product->colors;

        foreach ($colors as $color) {
            # code...
            if($color->quantity > 0){
                $rutasImagenes[] = $color->image->name;
            }
        }
    
        $zip = new ZipArchive();
        $nombreArchivoZip = $product->slug.'.zip';
        $rutaArchivoZip = public_path($nombreArchivoZip);
    
        if ($zip->open($rutaArchivoZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($rutasImagenes as $rutaImagen) {
                $nombreArchivo = basename($rutaImagen);
                $rutaCompleta = public_path(storage::url($rutaImagen));
    
                $zip->addFile($rutaCompleta, $nombreArchivo);
            }
    
            $zip->close();
    
            return response()->download($rutaArchivoZip)->deleteFileAfterSend(true);
        }
    
        return response('No se pudo crear el archivo ZIP', 500);

    }

    public function downLoadStock($nickname, Product $product){

        $colors = $product->colors;

        $rutasImagenes = [];
        $descargas = [];
        $i = 0;

        foreach ($colors as $color) {
            # code...
            $rutasImagenes[] = $color->image->name;

            $descargas[] = response()->download(public_path(Storage::url($rutasImagenes[$i])), $i.".jpg");

            $i++;
        }
        return $descargas;

        // $descargas = [];

        // $rutasImagenes = [];

        // $i=0;

        // foreach ($colors as $color) {

        //     $rutasImagenes[] = $color->image->name;

        //     $nombreArchivo = basename($rutasImagenes[$i]);
        //     $rutaCompleta = public_path(Storage::url($rutasImagenes[$i]));
    
        //     $headers = [
        //         'Content-Type' => 'image/jpeg', // Ajusta el tipo MIME según el formato de tus imágenes
        //     ];
    
        //     $descargas[] = response()->download($rutaCompleta, $nombreArchivo, $headers);

        //     $i++;
        // }

        // return $descargas;

        // return response()->download(asset(Storage::url($rutasImagenes[0])), "descargar.jpg");
        

        // return $rutasImagenes;
        // $rutasImagenes = [
        //     'ruta/imagen1.jpg',
        //     'ruta/imagen2.jpg',
        //     'ruta/imagen3.jpg',
        // ];

        // // Crear un directorio temporal para almacenar las imágenes descargadas
        // $directorioTemporal = storage_path('temp');
        // File::makeDirectory($directorioTemporal);

        // // Descargar cada imagen individualmente
        // foreach ($rutasImagenes as $rutaImagen) {
        //     // Obtener el nombre del archivo de la ruta completa
        //     $nombreArchivo = basename($rutaImagen);

        //     // Generar una nueva ruta para almacenar la imagen descargada
        //     $rutaDescarga = $directorioTemporal . '/' . $nombreArchivo;

        //     // Descargar la imagen
        //     File::copy(public_path($rutaImagen), $rutaDescarga);

        //     // Descargar la imagen
        //     return response()->download($rutaDescarga, $nombreArchivo)->deleteFileAfterSend();
        // }

        // // Eliminar el directorio temporal después de la descarga
        // File::deleteDirectory($directorioTemporal);
    }
}
