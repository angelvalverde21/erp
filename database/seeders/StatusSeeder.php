<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $status = [

            [
                'id'=> 1,
                'name' => 'creado',
                'title' => 'CREADO'
            ],

            [
                'id'=> 2,
                'name' => 'entregado',
                'title' => 'ENTREGADO'
            ],
            [
                'id'=> 3,
                'name' => 'esperando_revision',
                'title' => 'ESPERANDO REVISION'
            ],
            [
                'id'=> 4,
                'name' => 'aprobado',
                'title' => 'PEDIDO APROBADO'
            ],
            [
                'id'=> 5,
                'name' => 'cancelado',
                'title' => 'CANCELADO',
            ],
            [
                'id'=> 6,
                'name' => 'preparando_envio',
                'title' => 'PREPARANDO PARA ENVIO',
            ],
            [
                'id'=> 7,
                'name' => 'en_transito',
                'title' => 'EN TRANSITO',
            ],
            [
                'id'=> 8,
                'name' => 'listo_para_recoger',
                'title' => 'LISTO PARA RECOGER',
            ],
            [
                'id'=> 9,
                'name' => 'pendiente_entrega',
                'title' => 'PENDIENTE DE ENTREGA',
            ],
            [
                'id'=> 10,
                'name' => 'reclamado',
                'title' => 'RECLAMADO',
            ],
            [
                'id'=> 11,
                'name' => 'reclamo_aceptado',
                'title' => 'RECLAMO ACEPTADO',
            ],
            [
                'id'=> 12,
                'name' => 'en_proceso_devolucion',
                'title' => 'EN PROCESO DE DEVOLUCION',
            ],
            [
                'id'=> 13,
                'name' => 'devuelto',
                'title' => 'DEVUELTO',
            ],
            [
                'id'=> 14,
                'name' => 'reclamo_denegado',
                'title' => 'RECLAMO DENEGADO',
            ],
            [
                'id'=> 15,
                'name' => 'pago_confirmado',
                'title' => 'PAGO CONFIRMADO',
            ],
            [
                'id'=> 16,
                'name' => 'listo_para_envio',
                'title' => 'LISTO PARA SER ENVIADO',
            ],

        ];

        foreach ($status as $value) {
            Status::create(
                $value
            );
        }
    }
}
