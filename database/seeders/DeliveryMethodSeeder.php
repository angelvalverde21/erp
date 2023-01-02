<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                //DB::table('categories')->delete();
                $json = File::get("database/data/delivery_methods.json");

                $data = json_decode($json);
        
                foreach($data as $obj) {
        
                    DeliveryMethod::create(
        
                        [
                            'id' => $obj->id,
                            'name' => $obj->name,
                            'title' => $obj->title
                        ]
        
                    );
        
                }
    }
}
