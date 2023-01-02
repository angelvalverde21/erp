<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SizeSeeder extends Seeder
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
        $json = File::get("database/data/sizes.json");
        
        $data = json_decode($json);


        $products = Product::all();

        foreach ($products as $product) {

            foreach($data as $obj) {

                if ($product->id == $obj->product_id) {
                    Size::create(
    
                        [
                            'id' => $obj->id,
                            'name' => $obj->name,
                            'quantity' => $obj->quantity,
                            'product_id' => $obj->product_id
                        ]
        
                    );
                }


    
            }
        }


    }
}
