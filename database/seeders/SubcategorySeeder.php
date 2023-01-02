<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;

use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SubcategorySeeder extends Seeder
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
        $json = File::get("database/data/subcategories.json");
        
        $data = json_decode($json);

        foreach($data as $obj) {

            Subcategory::create(

                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'category_id' => $obj->category_id,
                    'has_color' => $obj->has_color,
                    'has_size' => $obj->has_size,
                    'slug' => Str::slug($obj->name)
                ]

            );

            Image::factory(1)->create([
                'name' => 'subcategories/' . $this->faker->image('public/storage/subcategories',640,480,null,false),
                'imageable_type' => Subcategory::class,
                'imageable_id' => $obj->id
            ]);

        }
    }
}
