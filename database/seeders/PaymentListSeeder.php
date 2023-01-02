<?php

namespace Database\Seeders;

use App\Models\PaymentList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PaymentListSeeder extends Seeder
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
        $json = File::get("database/data/payment_lists.json");

        $data = json_decode($json);

        foreach ($data as $obj) {

            PaymentList::create(

                [
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'title' => $obj->title
                ]

            );
        }
    }
}
