<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CarouselSeeder extends Seeder
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

        // $json = File::get("database/data/carousel.json");

        // $data = json_decode($json);

        $productos = Product::all();

        $i = 0;

        foreach ($productos as $product) {

            $i++;

                Carousel::create(

                    [
    
                        'title' => $product->title,
                        'sub_title' => $product->title,
                        'slug' => $product->slug,
                        'image' => 'stores/carousel/' . $this->faker->image('public/storage/stores/carousel',1920,800, null, false),
                        'store_id' => $product->store_id,
    
                    ]
    
                );

                if ($i==10) {
                    # code...
                    break;
                }

        }
    }
}
