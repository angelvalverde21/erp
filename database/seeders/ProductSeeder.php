<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //

        $i = 0;

        $this->faker = Faker::create();

        //DB::table('products')->delete();
        $json = File::get("database/data/products.json");
        $data = json_decode($json);

        foreach ($data as $obj) {

            $i = $i + 1;

            if($i>5){
                $store_id = 10;
            }else{
                $store_id = 11;
            }

            Product::create(

                array(
                    'id' => $obj->IDPRODUCTO,
                    'title' => $obj->TITULO,
                    'name' => $obj->TITULO,
                    'quantity' => 27,
                    'short_link' => substr(md5(bcrypt(Str::slug($obj->TITULO))),0,5),
                    'slug' => Str::slug($obj->TITULO),
                    'description' => $obj->DESCRIPCION,
                    'price' => '19.75',
                    'status' => '1',
                    'store_id' => $store_id,
                    'owner_id' => 1,
                    'category_id' => '2',
                    'excerpt' => $obj->EXCERPT,
                    'created_at' => $obj->FECHA,
                    'updated_at' => $obj->ACTUALIZAR
                )

            );


            for ($j = 1; $j <= 5; $j++) {
                Image::create([
                    'name' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
                    'imageable_id' => $obj->IDPRODUCTO,
                    'imageable_type' => Product::class
                ]);
            }

            if ($i == 10) {
                break;
            }

        }
    }
}
