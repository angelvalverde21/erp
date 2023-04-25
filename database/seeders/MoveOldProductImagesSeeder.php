<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class MoveOldProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $colors = Color::all();

        Log::info('se han obtenido todos los colores');


        foreach ($colors as $color) {
            # code...

            Log::info('se han empezado a recorrer los todos los colores');

            $images = $color->images()->get();

            // ojo la linea de arriba tambien se podria escribir com_load_typelib
            // $images = $color->images;

            Log::info("el numero de imagenes es: " . $color->images->count());

            Log::info($images);

            Log::info('se han empezado a extraer las imagees de cada color');

            foreach ($images as $image) {

                # code...
                Log::info("empezando el bucle para cada imagen correspondiente al color id: " . $color->id);

                $name = explode('/', $image->name);

                //copiando la imagen original
                Storage::copy(
                    "old_uploads/" . $name[2],
                    $image->name
                );

                // //copiando em thumbnail
                // $fileName = md5($originalName.time().rand(1, 1000)).'.'.$extension;
                // Storage::copy(
                //     "old_uploads/" . $name[2],
                //     $image->name
                // );

                // //copiando la imagen medium
                // Storage::copy(
                //     "old_uploads/" . $name[2],
                //     $image->name
                // );

                // //copiando la imagen large
                // Storage::copy(
                //     "old_uploads/" . $name[2],
                //     $image->name
                // );

                //Accediendo a la imagen recien copiada
                // $imageIntervention = Image::make($image->name);

                // //Reduciendo de tamano
                // $imageIntervention->resize($image->name->width() / 2, $image->name->height() / 2);

                // //Buscando donde se almaceno la imagen
                // $path = Storage::path($image->name);

                // //Guardando los cambios
                // $imageIntervention->save($path);
            }
        }


        $products = Product::all();

        foreach ($products as $product) {
            # code...

            foreach ($product->images as $image) {
                # code...
                $name = explode('/', $image->name);

                Storage::copy(
                    "old_uploads/" . $name[2],
                    $image->name
                );
            }


            foreach ($product->medidas as $medida) {
                # code...
                $name = explode('/', $medida->name);

                Storage::copy(
                    "old_uploads/" . $name[2],
                    $medida->name
                );
            }
        }
    }
}
