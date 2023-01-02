<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;
use App\Models\District;

class DistrictSeeder extends Seeder
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

        $json = File::get("database/data/districts.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            District::create(

                [
                    'id' => $obj->IDDISTRITO,
                    'name' => $obj->NOMBREDISTRITO,
                    'province_id' => $obj->IDPROVINCIA
                ]

            );
        }
    }
}
