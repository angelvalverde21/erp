<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Milon\Barcode\DNS2D;
use TCPDF;

class PdfProductController extends Controller
{
    //
    public function generateVaucher(Order $order)
    {

        $pdf = app('dompdf.wrapper');

        $pdf->set_paper([0, 0, 283.465, 595]); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        $pdf = $pdf->loadview('livewire.user.sales.imprimir.voucher', compact('order'));

        //return $pdf-> download ('prueba.pdf');
        return $pdf->stream('voucher.pdf');
    }


    public function generatePackingLabel(Order $order)
    {

        $pdf = app('dompdf.wrapper');

        $pdf->set_paper('A4', 'portrait'); // 283.465  puntos equivale a 10 cms y 510.236 equivale a 18cms
        $pdf = $pdf->loadview('livewire.user.sales.imprimir.packing-label', compact('order'));

        //return $pdf-> download ('prueba.pdf');
        return $pdf->stream('packing.pdf');
    }

    public function printDeals()
    {

        $products = Product::all();

        // Crea una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Establece el título y los márgenes del documento
        $pdf->SetTitle('PDF con coordenadas');
        // $pdf->SetMargins(10, 10, 10);

        $pdf->SetPrintHeader(false);

        // Agrega una nueva página
        $pdf->AddPage();

        //dibujando un circulo

        $pdf->Circle(38, 18, 2.5, 0, 360, '', array(), 1, false, 'D');

        // Establece la fuente y el tamaño del texto
        $pdf->SetFont('helvetica', '', 20);

        //graficando un rectangulo

        $pdf->SetXY(15, 10);
        $pdf->SetCellPaddings(5, 15, 2, 2);
        $pdf->MultiCell(45, 125, 'CHOMPA DE CHENILL', 1, 'L', false, false);
        // $pdf->Cell(35, 85, 'CHOMPA DE HILO',1, 0, 'C', false); //Si en ves de 0 se pone 1, entonces habra un salto de linea
        // $pdf->Cell(0, 10, 'Texto', 'T', 0, 'C', false);

        // Dibujando una linea

        $pdf->Line(20, 55, 55, 55);

        $pdf->SetCellPaddings(0, 5, 0, 5);
        //cuadro de
        $pdf->SetFont('helvetica', 'B', 23);
        $pdf->SetXY(20, 60);
        $pdf->MultiCell(35, 10, '50% OFF', 1, 'L');

        $pdf->SetXY(15, 10);

        $pdf->SetFont('helvetica', 'B', 12);

        $qr = new DNS2D();

        $pdf->Image('@' . $qr->getBarcodePNG('46515616565', 'QRCODE'), 80, 60, 20, 20, 'PNG');

        // Texto tachado
        // Establecer el estilo de línea para el texto tachado
        $pdf->Line(23, 110, 52, 110);

        $pdf->SetFont('helvetica', '', 17);
        $pdf->SetXY(15, 102);
        // Agregar un MultiCell con texto tachado
        $pdf->MultiCell(45, 10, 'S/. 79.95', 0, 'C');
        // fin de texto tachado

        $pdf->SetFont('helvetica', 'B', 30);
        $pdf->SetXY(15, 110);
        $pdf->MultiCell(45, 10, 'S/. 39.95', 0, 'C');

        // $pdf->SetXY(170, 10);
        // $pdf->Cell(40, 90, 'Texto',1);

        // Agrega texto en coordenadas específicas
        // $pdf->SetXY(0, 50);
        // $pdf->Cell(0, 10, 'Texto');

        // Genera la salida del PDF
        $pdf->Output('documento.pdf', 'I');
    }
}
