<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
// use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class InsertOldColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public $faker;

    public function run()
    {
        //
        // $this->faker = Faker::create();

        // $json_data = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_multimedia.json");

        // $colors = json_decode($json_data); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        $images = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_multimedia.json");
        // fotos_producto
        $i = 0;
        $f = 0;

        foreach ($images as $image) {

            switch ($image->TIPO) {

                case 'color':

                    Log::info('Se esta empezando la insersion del color con id multimedia: ' . $image->IDMULTIMEDIA . " del product_id: ".$image->IDPRODUCTO);

                    try {

                        $new_color = Color::create(

                            [
                                'id' => $image->IDMULTIMEDIA,
                                // 'name' => $this->faker->word(),
                                'quantity' => '1',
                                'label' => $image->LABEL,
                                'product_id' => $image->IDPRODUCTO,
                                // 'created_at' => $images->FECHA,
                                // 'updated_at' => $images->ACTUALIZAR,
                            ]

                        );
                        

                        $new_color->images()->create([
                            'name' => 'products/colors/' . $image->ARCHIVO,
                            'usage' => 'color'
                        ]);

                        Log::info('Ha terminado la insersion del color con id multimedia: ' . $image->IDMULTIMEDIA);
                        Log::info(' ');

                    } catch (\Exception $e) {

                        $f++;
                        Log::info('Ha fallado la insersion del color con id multimedia:  ' . $image->IDMULTIMEDIA);
                        Log::info(' ');
                        // something went wrong
                        Log::info($e);
                    }

                    break;

                case 'fotos_producto':
                    # code...

                    try {

                        $product = Product::find($image->IDPRODUCTO)->limit(1)->first();

                        Log::info('Se esta empezando la insersion de la foto con id multimedia: ' . $image->IDMULTIMEDIA . " del product_id: ".$image->IDPRODUCTO);

                        $product->images()->create([
                            'name' => 'products/images/' . $image->ARCHIVO,
                            'usage' => 'images'
                        ]);

                        Log::info('Ha terminado la insersion de la foto con id multimedia: ' . $image->IDMULTIMEDIA);
                        Log::info(' ');


                    } catch (\Exception $e) { 

                        $f++;
                        Log::info('Ha fallado la insersion de la foto con id multimedia:  ' . $image->IDMULTIMEDIA);
                        Log::info(' ');
                        // something went wrong
                        Log::info($e);
                    }

                    break;

                case 'medidas_producto':
                    # code...

                    try {

                        $product = Product::find($image->IDPRODUCTO)->limit(1)->first();

                        Log::info('Se esta empezando la insersion de la medida con id multimedia: ' . $image->IDMULTIMEDIA . " del product_id: ".$image->IDPRODUCTO);

                        $product->images()->create([
                            'name' => 'products/medidas/' . $image->ARCHIVO,
                            'usage' => 'medidas_producto'
                        ]);

                        Log::info('Ha terminado la insersion de la medida con id multimedia: ' . $image->IDMULTIMEDIA);
                        Log::info(' ');


                    } catch (\Exception $e) { 

                        $f++;
                        Log::info('Ha fallado la insersion de la medida con id multimedia:  ' . $image->IDMULTIMEDIA);
                        Log::info(' ');
                        // something went wrong
                        Log::info($e);
                    }

                    break;

                default:
                    # code...
                    Log::info('el id: ' . $image->IDMULTIMEDIA . ' no es del tipo color o fotos_producto');

                    break;
            }
        }

        Log::info('Se insertaron correctamente (addresses) ' . $i . ' registros');
        Log::info('fallaron en la insercion (addresses) ' . $f . ' registros');
    }
}
