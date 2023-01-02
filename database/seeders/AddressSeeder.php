<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;

class AddressSeeder extends Seeder
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
        $json = File::get("database/data/addresses.json");

        $data = json_decode($json);

        foreach($data as $obj) {

            Address::create(

                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'dni' => $obj->dni,
                    'phone' => $obj->phone,
                    'primary' => $obj->primary,
                    'secondary' => $obj->secondary,
                    'references' => $obj->references,
                    'user_id' => $obj->user_id,
                    'district_id' => $obj->district_id
                ]

            );

        }
    }
}
