<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class InsertOldAmountPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $new_orders = Order::all();

        foreach ($new_orders as $order) {
            # code...

            $amount = 0;

            foreach ($order->items as $item) {
                # code...
                // Log::info($item->content->price);

                if(isset($item->content->price)){

                    $amount = $amount + $item->content->price;
                    Log::info($item->content->price);

                }else{
                    Log::info('el content->price no esta definido');
                }
                
            }

            Log::info('El total de la orden '.$order->id.' es: '. $amount);

            // Log::info($amount);
            foreach ($order->payments as $payment) {
                # code...
                Log::info('el payment asociado es: '. $payment);

                $payment->amount = $amount;
                
                $payment->save();

                break;

            }
            //$payment = $order->payments; //hacemos esto porque la base de datos anterior que ha sido copiada a new_orders solo tenia una imagen o vaucher como comprobante de pago




            // $payment->amount = $amount;

            // $payment->save();

        }
    }
}
