<div>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

        {{-- CASOS DE ENVIO

        ENVIO CONTRA ENTREGA
            
            PAGO EN EFECTIVO (PREGUNAR EL MONTO PARA EL VUELTO)
            PAGO POR APLICATIVO YAPE, PLIN (ESTO REQUERIRA IMPRIMIR EL QR Y LAS CUENTAS)
            PAGO CON TRANSFERENCIA ( ESTO REQUERIRA IMPRIMIR EL QR Y LAS CUENTAS)
            
        ENVIO PREVIO DEPOSITO
        
            LIMA
        
                ARA EXPRESS
                    *SE NECESITAN TODOS LOS DATOS DE ENVIO  (NO SE NECESITAN QR NI IMPRIMIR CUENTAS)
                OLVA COURIER (PUERTA A PUERTA)
                    *SE NECESITAN TODOS LOS DATOS DE ENVIO  (NO SE NECESITAN QR NI IMPRIMIR CUENTAS)
        
            PROVINCIA
            
                OLVA COURIER 
                    OLVA ENVIA PUERTA A PUERTA  (NO SE NECESITAN QR NI IMPRIMIR CUENTAS)
                    *SE NECESITAN TODOS LOS DATOS DE ENVIO
                    *NOMBRE, DNI, TELEFONO, DIRECCION, REFERENCIA Y CIUDAD
        
                EMPRESAS DE TRANSPORTES
                    SOLO SE NECESITA
                    *NOMBRE, DNI, TELEFONO Y CIUDAD  (NO SE NECESITAN QR NI IMPRIMIR CUENTAS) --}}

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
                border: 0px solid #ccc;
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
                margin: 0 0px 5px 0px;
                padding: 3px 10px;
                background-color: #E1E1E1;
            }

            

            .ship-to .large {
                font-weight: bold;
                font-size: 12pt;
                margin: 0;
                padding: 0;
            }


            .ship-to p{
                margin: 0px;
                padding: 0px;
                border: 0px solid #000;
            }

            .ship-details ul {
                margin: 0;
                padding: 0 10px !important;
                border: 0px solid #ccc;
            }

            .sender-details {
                margin: 10px 0 0 0;
                padding: 0px 10px !important;
                border: 0px solid #ccc;
                background-color: #E1E1E1;
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
                border: 1px solid #ccc;
            }

            .plin {
                position: absolute;
                top: ;
                left: 60mm;
                width: 25mm;
                height: 25mm;
                border: 1px solid #ccc;
            }

            .code {
                position: absolute;
                top: ;
                left: 32.5mm;
                width: 25mm;
                height: 25mm;
                border: 1px solid #ccc;
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
                font-size: 11pt;
                display: block;
            }

  
        </style>
    </head>

    <body>

        <div class="label-left">
            <div class="logo">
                <img style="width: 50%; height: auto;" src="{{ asset(Storage::url($order->store->upload_logo_general)) }}" alt="">
            </div>
            <div class="ship-to py-0">
                <p>DESTINATARIO: </p>
                <p class="large">{{ $order->address->name }}</p>
            </div>

            <div class="ship-details">
                <ul class="">
                    <li><span class="">DNI:</span> {{ $order->address->dni }}</li>
                    <li><span class="fw-bold">TELEFONO:</span> {{ $order->address->phone }}</li>
                    <li><span class="">DIRECCION:</span> {{ $order->address->primary }}</li>
                    <li>{{ $order->address->secondary }}</li>
                    <li class="fw-bold">{{ $order->address->district->name }} -
                        {{ $order->address->district->province->name }} -
                        {{ $order->address->district->province->department->name }}</li>
                    <li>
                        {{-- <span class="">REFERENCIA:</span>  --}}
                        {{ $order->address->references }}</li>

                </ul>
            </div>

            <div class="sender-details">
                <li>REMITE: VANESA HINOSTROZA GONZALES</li>
                <li>DNI: 45631639</li>
                <li>CEL: 945101774</li>
                <li>Residencial Patria Nueva S/N, Los olivos - LIMA</li>
            </div>

            <style>
                .codigo-barras{

                }
            </style>

            <div class="codigo-barras my-3 text-center">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG('011136', 'C39+',2,70) }}" alt="barcode"/>
                <p style="font-size: 14pt">#011136</p>
            </div>

            <div class="carrier-address text-center">
                <li>{{ $order->carrier_address->title }}</li>
                <li>{{ $order->carrier_address->primary }}, {{ $order->carrier_address->district->name }} - {{ $order->carrier_address->district->province->name }} - {{ $order->carrier_address->district->province->department->name }}</li>
            </div>



        </div>

        <div class="label-right">

            <div class="status-pago">
                <h1>PENDIENTE DE PAGO</h1>
            </div>

            <div class="qr">
                <div class="yape text-center">
                    {{-- <img src="{{ asset(Storage::url($order->store->upload_qr_yape)) }}"
                        alt="barcode" height="90" width="90" /> --}}
                        <img src="{{ asset(Storage::url($order->store->upload_qr_yape)) }}"
                        alt="barcode" height="95" width="95" />
                    <span>YAPE</span>
                </div>

                <div class="plin text-center">
                    <img src="{{ asset(Storage::url($order->store->upload_qr_plin)) }}"
                        alt="barcode" height="90" width="90" />
                    <span>PLIN</span>
                </div>
            </div>
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
