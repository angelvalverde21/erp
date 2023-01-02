<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Department;

class DepartmentSeeder extends Seeder
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

        $json = File::get("database/data/departments.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            Department::create(

                [
                    'id' => $obj->IDDEPARTAMENTO,
                    'name' => $obj->NOMBREDEPARTAMENTO
                ]

            );
        }
    }
}
