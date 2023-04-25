<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MoveOldOrderImagesSeeder extends Seeder
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

        Log::info('se han obtenido todas las ordenes');
        

        foreach ($orders as $order) {
            # code...

            Log::info('se han empezado a recorrer los todos las ordenes: OrderId : '. $order->id);

            $payments = $order->payments()->get();

            $comprobantes_empaque = $order->comprobantesEmpaque()->get();

            $comprobantes_envio = $order->comprobantesEnvio()->get();

            // ojo la linea de arriba tambien se podria escribir com_load_typelib
            // $images = $order->payments;

            Log::info("el numero de payments es: ".$order->payments()->count());

            Log::info($payments);

            Log::info('se han empezado a extraer los payments de cada order');

            //OJO Payments va separado porque necesita mas campos como amount, etc
            foreach ($payments as $payment) {
                # code...
                Log::info("empezando el bucle para cada imagen correspondiente al color id: ".$payment->id);

                $name = explode('/',$payment->image);

                Storage::copy(
                    "old_uploads/".$name[3], //Origen
                    $payment->image //Destino
                );
            }

            
            foreach ($comprobantes_empaque as $empaque) {
                # code...
                Log::info("empezando el bucle para cada imagen correspondiente al color id: ".$empaque->id);

                $name = explode('/',$empaque->name);

                Storage::copy(
                    "old_uploads/".$name[3], //Origen
                    $empaque->name //Destino
                );
            }

            
            foreach ($comprobantes_envio as $envio) {
                # code...
                Log::info("empezando el bucle para cada imagen correspondiente al color id: ".$envio->id);

                $name = explode('/',$envio->name);

                Storage::copy(
                    "old_uploads/".$name[3], //Origen
                    $envio->name //Destino
                );
            }


        }

    }
}
