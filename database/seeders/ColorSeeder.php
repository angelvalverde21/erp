<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Color;

use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //



        $this->faker = Faker::create();

        //DB::table('categories')->delete();
        $json = File::get("database/data/colors.json");

        $data = json_decode($json);

        $products = Product::all();

        foreach ($products as $product) {

            $k=0;

            foreach ($data as $obj) {

                if ($product->id == $obj->post_id AND $k<3) {

                    $k++; //K puede ser 1 o maximo 5;

                    $color = Color::create(

                        [
                            'id' => $obj->id,
                            'name' => $this->faker->word(),
                            'quantity' => '1',
                            'product_id' => $obj->post_id
                        ]

                    );

                    Image::create([
                        'name' => 'colors/' . $this->faker->image('public/storage/colors', 640, 480, null, false),
                        'imageable_id' => $color->id,
                        'imageable_type' => Color::class,
                        'usage' => 'color'
                    ]);

                }
            }

        }
    }
}
