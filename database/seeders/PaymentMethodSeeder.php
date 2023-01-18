<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PaymentMethodSeeder extends Seeder
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
                        $json = File::get("database/data/payment_methods.json");

                        $data = json_decode($json);
                
                        foreach($data as $obj) {

                            if(!isset($obj->payment_method_id)){
                                $obj->payment_method_id = null;
                            }
                
                            PaymentMethod::create(
                
                                [
                                    'id' => $obj->id,
                                    'name' => $obj->name,
                                    'payment_method_id' => $obj->payment_method_id,
                                ]
                
                            );
                
                        }
    }
}
