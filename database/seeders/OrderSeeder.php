<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;

class OrderSeeder extends Seeder
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
        $json = File::get("database/data/orders.json");

        $data = json_decode($json);

        foreach($data as $obj) {

            Order::create(

                [
                    'id' => $obj->id,
                    'seller_id' => User::MAIN_ID,
                    'buyer_id' => $obj->buyer_id,
                    'address_id' => $obj->address_id,
                    'delivery_man_id' => $obj->delivery_man_id,
                    'carrier_address_id' => $obj->carrier_address_id,
                    'shipping_cost_carrier' => $obj->shipping_cost_carrier,
                    'shipping_cost_buyer' => $obj->shipping_cost_buyer,
                ]

            );

        }
    }
}
