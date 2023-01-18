<?php

namespace App\Http\Controllers\Manage\Print\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class PdfController extends Controller
{
    
    //
    public function generateVaucher($store, Order $order){
    
        $pdf = app('dompdf.wrapper');
   
        $pdf->set_paper([0, 0, 283.465, 595]); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        
        $pdf = $pdf->loadview('livewire.manage.orders.print.voucher', compact('order'));
        //return view('livewire.manage.orders.print.voucher', compact('order'));
        //return $pdf-> download ('prueba.pdf');

        $order->changes()->create([
            'name'=>'send_vaucher',
            'content'=> Request::HEADER_FORWARDED
        ]);

        return $pdf->stream('voucher.pdf');

    }

    public function generatePackingLabel($store, Order $order){

        // $current = urldecode($current);

        // $order->actions()->create([
        //     'name'=>'print_packing_label',
        //     'content'=>[
        //         'label'=>'packing',
        //         ''
        //     ]
        // ]);

        $order->changes()->create([
            'name'=>'print_packing_label',
            'content'=> ''
        ]);

        $pdf = app('dompdf.wrapper');
   
        $pdf->set_paper('A4', 'portrait'); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        $pdf = $pdf->loadview('livewire.manage.orders.print.packing-label', compact('order'));

        // $order->Addstatus('preparando_envio', $current);

        //return $pdf-> download ('prueba.pdf');
        return $pdf->stream('packing.pdf');
        
    }
}
