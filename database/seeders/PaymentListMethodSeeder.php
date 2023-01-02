<?php

namespace Database\Seeders;

use App\Models\PaymentListMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PaymentListMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $listMethods =

        //DB::table('categories')->delete();
        $json = File::get("database/data/payment_list_method.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            PaymentListMethod::create(

                [
                    'id' => $obj->id,
                    'payment_method_id' => $obj->payment_method_id,
                    'payment_list_id' => $obj->payment_list_id
                ]

            );
        }
    }
}
