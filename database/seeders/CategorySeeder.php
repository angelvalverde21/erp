<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        //DB::table('categories')->delete();
        $json = File::get("database/data/categories.json");
        
        $data = json_decode($json);

        foreach($data as $obj) {

            if(!isset($obj->category_id)){
                $obj->category_id = null;
            }

            Category::create(

                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'slug' => Str::slug($obj->name),
                    'category_id' => $obj->category_id,
                    'has_size' => $obj->has_size,
                    'has_color' => $obj->has_color
                ]

            );

            Image::factory(1)->create([
                'name' => 'categories/' . $this->faker->image('public/storage/categories',640,480,null,false),
                'imageable_type' => Category::class,
                'imageable_id' => $obj->id
            ]);

        }
    }
}
