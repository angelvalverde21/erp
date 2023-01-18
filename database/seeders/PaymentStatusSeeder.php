<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PaymentStatusSeeder extends Seeder
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
        $json = File::get("database/data/payment_status.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            PaymentStatus::create(

                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'title' => $obj->title,
                ]

            );
        }
    }
}
