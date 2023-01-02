<?php

namespace App\Http\Controllers;

use App\Models\Order;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class PdfController extends Controller
{
    //
    public function generateVaucher(Order $order){

        $pdf = app('dompdf.wrapper');
   
        $pdf->set_paper([0, 0, 283.465, 595]); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        $pdf = $pdf->loadview('livewire.user.sales.imprimir.voucher', compact('order'));

        //return $pdf-> download ('prueba.pdf');
        return $pdf->stream('voucher.pdf');
    }


    public function generatePackingLabel(Order $order){

        $pdf = app('dompdf.wrapper');
   
        $pdf->set_paper('A4', 'portrait'); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        $pdf = $pdf->loadview('livewire.user.sales.imprimir.packing-label', compact('order'));

        //return $pdf-> download ('prueba.pdf');
        return $pdf->stream('packing.pdf');
        
    }
}
