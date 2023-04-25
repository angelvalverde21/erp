<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class InsertOldOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $json_data = File::get("C:/xampp/htdocs/erp/database/import_old_db/ayv_ventas.json");

        // $orders_json = json_decode($json_data); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        $old_orders_json = getJson("C:/xampp/htdocs/erp/database/import_old_db/ayv_ventas.json"); //true convierte al json en una matriz asociativa, esto quiere decir que los keys son string y estan asociados a su valor

        // Log::info(count($products_json));

        $i = 0;
        $f = 0;

        foreach ($old_orders_json as $old_order) {

            Log::info('Se esta empezando la insersion de IDVENTA: ' . $old_order->IDVENTA);

            try {

                $new_order = Order::create(

                    [
                        // 'id' => $old_order->IDVENTA,
                        // 'seller_id' => User::MAIN_ID,
                        // 'buyer_id' => $old_order->IDUSUARIO,
                        // 'address_id' => $old_order->IDENVIO,
                        // 'delivery_man_id' => User::VANE_ID,
                        // 'carrier_address_id' => $old_order->carrier_address_id,
                        // 'shipping_cost_carrier' => $old_order->shipping_cost_carrier,
                        // 'shipping_cost_buyer' => $old_order->shipping_cost_buyer,


                        'id' => $old_order->IDVENTA,
                        'seller_id' => User::MAIN_ID,
                        'buyer_id' => $old_order->IDUSUARIO,
                        'store_id' => User::STORE_ID,
                        'address_id' => $old_order->IDENVIO,
                        'payment_method_id' => 1, //efectivo
                        'delivery_method_id' => 1, //via delivery
                        'collect_method_id' => 2, //previo deposito
                        'delivery_man_id' => User::VANE_ID,
                        'carrier_address_id' => 4, //de la tabla address es olva courier el numero 4, en este caso address se usa como oficina
                        'shipping_cost_to_carrier' => corregirPrecio($old_order->GASTOS_TRASLADO),
                        'shipping_cost_carrier' => corregirPrecio($old_order->COSTO_ENVIO_REAL),
                        'shipping_cost_buyer' => corregirPrecio($old_order->COSTO_ENVIO),
                        'delivery_date' => corregirFecha($old_order->FECHAENTREGA),
                        'delivery_time_start' => $old_order->HORAIN,
                        'delivery_time_end' => $old_order->HORAOUT,
                        'photo_payment' => $old_order->COMPROBANTE_PAGO,
                        'photo_package' => $old_order->FOTO_PAQUETE,
                        'photo_delivery' => $old_order->CONSTANCIA_ENTREGA,
                        // 'feedback'=> $old_order->CALIFICACION_ENTREGA,
                        'observations_time' => $old_order->OBSERVACIONES_HORARIO,
                        'observations_public' => $old_order->OBSERVACIONES,
                        'observations_private' => $old_order->OBSERVACIONES_INTERNAS,
                        'observations_delivery' => $old_order->OBSERVACIONES_ENTREGA,
                        'created_at' => corregirFecha($old_order->FECHA),
                        'updated_at' => corregirFecha($old_order->ACTUALIZAR),

                    ]

                    // "IDVENTA":"11502", ---------------------------
                    // "IDUSUARIO":"9831",---------------------------
                    // "IDUSUARIO_REPARTIDOR":"0",-------------------
                    // "IDENVIO":"9674",-----------------------------
                    // "IDSTORE":"1",--------------------------------
                    // "IDVENDEDOR":"1",-----------------------------
                    // "IDFACTURACION":"8501",
                    // "IDREPARTIDOR":"1",---------------------------
                    // "FECHAENTREGA":"2023-04-18",------------------
                    // "HORAIN":"10:00:00",--------------------------
                    // "HORAOUT":"21:00:00",-------------------------
                    // "ORIGEN":"",
                    // "OBSERVACIONES_HORARIO":"",-------------------
                    // "TIPOPAGO":"1",
                    // "GASTOS_TRASLADO":"",-------------------------
                    // "OBSERVACIONES":"",---------------------------
                    // "OBSERVACIONES_ENTREGA":"",-------------------
                    // "CALIFICACION_ENTREGA":"0",
                    // "VOUCHER":"",
                    // "COMPROBANTE_PAGO":"f94200_screenshot2023-04-17-20-42-14-264comwhatsappw4b.jpg", ------------
                    // "FOTO_PAQUETE":"",----------------------------
                    // "BOLETA":"",
                    // "TRANSPORTE":"1",
                    // "COMPROBANTE_ENVIO":"",
                    // "REMITO_ENVIO":"",
                    // "PASS_ENVIO":"",
                    // "OBSERVACION_MONTO":"",
                    // "NOMBRE_COURIER":"",
                    // "MEDIOPEDIDO":"",
                    // "IDMEDIOPEDIDO":"1",
                    // "OBSERVACIONES_INTERNAS":"",------------------
                    // "PEDIDO_TOTAL":"",
                    // "CONSTANCIA_ENTREGA":"",
                    // "COSTO_ENVIO":"",-----------------------------
                    // "COSTO_ENVIO_REAL":"0",-----------------------
                    // "ESTADO":"9",
                    // "ESTADO_PAGO":"PENDIENTE DE PAGO",
                    // "TIPO_ENTREGA":"1",
                    // "TIPO_VENTA":"1",
                    // "URL_FB":"",
                    // "URL_FUENTE_PEDIDO":"",
                    // "URL_USUARIO_FUENTE":"",
                    // "NOTIFICADO_HASTA":"2023-04-17 20:42:25",
                    // "HASH":"3c9f0fc05e6ee6031ed71a90c3d4f88e",
                    // "FECHA":"2023-04-17 19:36:00",------------------------
                    // "ACTUALIZAR":"2023-04-17 20:54:27"}-------------------



                ); //fin de crear new_orden

                if ($old_order->COMPROBANTE_PAGO <> "") {

                    //Se guarda en la tabla payments
                    $new_order->payments()->create(
                        [
                            'image' => 'orders/comprobantes/pago/'.$old_order->COMPROBANTE_PAGO,
                            'payment_status_id' => 4, //pagado
                            'amount' => '0.00',
                            'content' => [],
                            'payment_method_id' => 8, //otros
                        ]
                    );

                }

                //Se guarda en la tabla images
                if ($old_order->FOTO_PAQUETE <> "") {
                    $new_order->comprobantesEmpaque()->create([ //crea un nuevo registro en la tabla images
                        'usage' => 'comprobante_empaque',
                        'name' => 'orders/comprobantes/empaque/'.$old_order->FOTO_PAQUETE,
                    ]);
                }

                //Se guarda en la tabla images
                if ($old_order->COMPROBANTE_ENVIO <> "") {
                    $new_order->comprobantesEnvio()->create([ //crea un nuevo registro en la tabla images
                        'usage' => 'comprobante_envio',
                        'name' => 'orders/comprobantes/envio/'.$old_order->COMPROBANTE_ENVIO,
                    ]);
                }

                Log::info('Se ha insertado correctamente IDVENTA: ' . $old_order->IDVENTA);

                //Creando las direcciones de envio
                //fin de crear direcciones de envio
                // all good

                $i++;
            } catch (\Exception $e) {

                $f++;
                Log::info('Ha fallado la insersion de la orden:  ' . $old_order->IDVENTA);
                // something went wrong
                // Log::info($e);
            }
        }

        Log::info('Se insertaron correctamente (orden) ' . $i . ' registros');
        Log::info('fallaron en la insercion (orden) ' . $f . ' registros');
    }
}
