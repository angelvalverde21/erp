<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class resizeImagesProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $products = Product::all();

        foreach ($products as $product) {

            //Esto ya esta listo
            // foreach ($product->images as $image) {
            //     # code...
            //     //Recibo la imagen
            //     $path_file = Storage::path($image->name);

            //     // $url = uploadImage($image, "products");
            //     $urlThumb = uploadSeeder($path_file, "products/thumb", 360);
            //     $urlMedium = uploadSeeder($path_file, "products/medium", 750);
            //     $urlLarge = uploadSeeder($path_file, "products/large", 1080);

            //     $image->update(
            //         [
            //             'thumbnail' => $urlThumb,
            //             'medium' => $urlMedium,
            //             'large' => $urlLarge,
            //         ]
            //     );


            //     // $image->save();

            // }

            foreach ($product->colors as $color) {
                # code...
                foreach ($color->images as $image) {
                    # code...

                    if ($image->thumbnail == null) {

                        //16814056
                        $path_file_color = Storage::path($image->name);

                        if(File::size($path_file_color) <= 10000000 ){

                            Log::info($path_file_color);
                            Log::info(File::size($path_file_color));
                            
                            if (file_exists($path_file_color)) {
                                // $url = uploadImage($image, "products");
                                $urlThumb = uploadSeeder($path_file_color, "products/colors/thumb", 360);
                                $urlMedium = uploadSeeder($path_file_color, "products/colors/medium", 750);
                                $urlLarge = uploadSeeder($path_file_color, "products/colors/large", 1080);
    
                                $image->update(
                                    [
                                        'thumbnail' => $urlThumb,
                                        'medium' => $urlMedium,
                                        'large' => $urlLarge,
                                    ]
                                );
                            }
                        }


                    }
                }
            }
        }
    }
}
