<div>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title>Label Packing</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                border: 1px solid #ccc;
                margin: 0px;
                font-family: sans-serif;
                font-size: 9pt;
                position: relative;
            }

            @page {
                margin: 0px;
                padding: 0px;
            }

            .label-left {
                border: 1px solid #ccc;
                width: 90mm;
                height: 133mm;
                position: absolute;
                top: 10mm;
                left: 10mm;
            }

            .label-right {
                border: 1px solid #ccc;
                width: 90mm;
                height: 133mm;
                position: absolute;
                top: 10mm;
                left: 110mm;
            }

            .logo {
                text-align: center;
                padding: 5px 0;
            }

            .logo img {
                width: auto;
                height: 60px;
                border: 0px solid #ccc
            }

            .ship-to {
                font-size: 11pt;
                font-weight: bold;
                margin: 0 0px 5px 0px;
                padding: 3px 10px;
                background-color: #E1E1E1;
            }

            .ship-to p {
                margin: 0;
                padding: 0;
            }

            .ship-details ul {
                margin: 0;
                padding: 0 10px !important;
                border: 1px solid #ccc;
            }

            .sender-details {
                margin: 10px 0 0 0;
                padding: 10px 10px !important;
                border: 1px solid #ccc;
                background-color: #E9E9E9;
            }

            .qr {
                width: 100%;
                height: 32mm;
                position: relative;
                border: 1px solid #ccc;
                margin: 10px 0 0;
                top: 10px;
            }

            .yape {
                position: absolute;
                top: 0;
                left: 5mm;
                width: 25mm;
                height: 25mm;
                border: 0px solid #ccc;
            }

            .plin {
                position: absolute;
                top: ;
                left: 60mm;
                width: 25mm;
                height: 25mm;
                border: 0px solid #ccc;
            }

            li {
                list-style: none;
                margin: 0;
                padding;
                0;
            }

            /*****/


            .barcode {
                text-align: center;
            }



            .qr {
                margin: 0;
                width: 30%;
                border: 0px solid #ccc;
                float: left;
            }

            .resumen {
                width: 60%;
                border: 0px solid #ccc;
                float: right;
                padding: 0 20px 0 0;
            }

            .status-pago {
                text-align: center;
                font-weight: bold;
                border: 0px solid #ccc;
                clear: both;
                display: block;
            }

  
        </style>
    </head>

    <body>

        <div class="label-left">
            <div class="logo">
                <img src="{{ asset(Storage::url($order->seller->upload_logo_invoice)) }}" alt="">
            </div>
            <div class="ship-to">
                <p>ENTREGAR A: </p>
                <p>{{ $order->address->name }}</p>
            </div>

            <div class="ship-details">
                <ul>
                    <li><span class="fw-bold">DNI:</span> {{ $order->address->dni }}</li>
                    <li><span class="fw-bold">TELEFONO:</span> {{ $order->address->phone }}</li>
                    <li><span class="fw-bold">DIRECCION:</span> {{ $order->address->primary }}</li>
                    <li>{{ $order->address->secondary }}</li>
                    <li>{{ $order->address->district->name }} -
                        {{ $order->address->district->province->name }} -
                        {{ $order->address->district->province->department->name }}</li>
                    <li><span class="fw-bold">REFERENCIA:</span> {{ $order->address->references }}</li>

                </ul>
            </div>

            <div class="sender-details">
                <li>REMITE: VANESA HINOSTROZA GONZALES</li>
                <li>DNI: 45631639</li>
                <li>CEL: 945101774</li>
                <li>Residencial Patria Nueva S/N, Los olivos - LIMA</li>
            </div>

            <div class="qr">
                <div class="yape text-center">
                    <img src="{{ asset(Storage::url($order->seller->upload_qr_yape)) }}"
                        alt="barcode" height="90" width="90" />
                    <span>YAPE</span>
                </div>
                <div class="plin text-center">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://3b.pe/erp/summary/imprimir/voucher.php?IDVENTA=10813', 'QRCODE') }}"
                        alt="barcode" height="90" width="90" />
                    <span>PLIN</span>
                </div>
            </div>


            <div class="status-pago">
                <h1>PENDIENTE DE PAGO</h1>
            </div>


        </div>

        <div class="label-right">

        </div>

        {{-- <div class="header">
            
            <h1>ORDEN DE COMPRA: #{{ $order->id }}</h1>
            <small style="padding: 0 10px">
                Aquarella Ropa y Accesorios, Tienda 100% Online Open 24/7,
                compra y recibe en casa en menos de 24 Horas
            </small>
            <hr class="linea-separador">
        </div>

        <div class="body-content">

            <div class="barcode">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG('2561465165024', 'C39') }}" alt="barcode"
                    height="30" width="300" />

                <small>2561465165024</small>
            </div>


        </div> --}}

        {{-- <div class="content-items pt-3 text-center">
            @foreach ($order->items as $item)
                <img class="px-1 pt-1" src="{{ asset(Storage::url($item->content->file_name)) }}" height="85px" alt="">
            @endforeach
        </div>

        <hr class="linea-separador">

        <div class="content-header pt-3">

            <div class="qr px-4">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://3b.pe/erp/summary/imprimir/voucher.php?IDVENTA=10813', 'QRCODE') }}"
                    alt="barcode" height="75" width="75" />
            </div>


        </div> --}}

    </body>

    </html>
</div>
