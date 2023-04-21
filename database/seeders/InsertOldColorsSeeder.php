<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Image;
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

        $json_data = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_multimedia.json");

        $colors = json_decode($json_data); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        $i = 0;
        $f = 0;

        foreach ($colors as $color) {




            if ($color->TIPO == 'color') {

                Log::info('Se esta empezando la insersion del color: ' . $color->IDMULTIMEDIA);
                
                try {

                    $new_color = Color::create(

                        [
                            'id' => $color->IDMULTIMEDIA,
                            // 'name' => $this->faker->word(),
                            'quantity' => '1',
                            'label' => $color->LABEL,
                            'product_id' => $color->IDPRODUCTO,
                            // 'created_at' => $color->FECHA,
                            // 'updated_at' => $color->ACTUALIZAR,
                        ]

                    );

                    Image::create([
                        'name' => 'colors/' . $color->ARCHIVO,
                        'imageable_id' => $new_color->id,
                        'imageable_type' => Color::class,
                        'usage' => 'color'
                    ]);

                } catch (\Exception $e) {

                    $f++;
                    Log::info('Ha fallado la insersion del color:  ' . $color->IDMULTIMEDIA);
                    // something went wrong
                    Log::info($e);
                }
            }else{
                Log::info('el id: ' . $color->IDMULTIMEDIA . ' no es del tipo color');
            }
        }

        Log::info('Se insertaron correctamente (addresses) ' . $i . ' registros');
        Log::info('fallaron en la insercion (addresses) ' . $f . ' registros');
    }
}
