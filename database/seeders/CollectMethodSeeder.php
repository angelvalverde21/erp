<?php

namespace Database\Seeders;

use App\Models\CollectMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CollectMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('categories')->delete();
        $json = File::get("database/data/collect_methods.json");

        $data = json_decode($json);

        foreach($data as $obj) {

            CollectMethod::create(
                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'title' => $obj->title
                ]
            );

        }
    }
}
