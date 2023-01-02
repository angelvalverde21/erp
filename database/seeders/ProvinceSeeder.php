<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;
use App\Models\Province;

class ProvinceSeeder extends Seeder
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

        $json = File::get("database/data/provinces.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            Province::create(

                [
                    'id' => $obj->IDPROVINCIA,
                    'name' => $obj->NOMBREPROVINCIA,
                    'department_id' => $obj->IDDEPARTAMENTO
                ]

            );
        }
    }
}
