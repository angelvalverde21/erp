<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\ColorSize;
use App\Models\Item;
use App\Models\Order;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class InsertOldOrdersDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $orders = Order::all();

        $old_items = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_ventas_detalles.json", true);

        foreach ($orders as $order) {
            # code...

            $result_old_items = array_filter($old_items, function ($old_item) use ($order) { //use ($user) se usa para poder usar la variable externa
                return $old_item['IDVENTA'] == $order->id;
            });

            //ingresando los items a la order
            foreach ($result_old_items as $partial_old_item) {
                # code...

                try {


                    Item::create(

                        [
                            'id' => $partial_old_item['IDDETALLE'],
                            'quantity' =>  $partial_old_item['CANTIDAD'],
                            'quantity_oversale' =>  '0.00',
                            'description' => $partial_old_item['DESCRIPCION'],
                            'price' => $partial_old_item['PRECIO_ETIQUETA'],
                            'content'  => [],
                            'order_id' => $partial_old_item['IDVENTA'],
                        ]

                    );

                    Log::info('Se ha insertado correctamente IDDETALLE: ' . $partial_old_item['IDDETALLE']);

                    //Creando las direcciones de envio
                    //fin de crear direcciones de envio
                    // all good


                } catch (\Exception $e) {


                    Log::info('Ha fallado la insersion del item:  ' . $partial_old_item['IDDETALLE']);
                    // something went wrong
                    Log::info($e);
                }
            }
        }

    }
}
