<div>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title>Voucher de venta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                border: 1px solid #ccc;
                margin: 0px;
                font-family: sans-serif;
                font-size: 10pt;
                padding: 0 10px;
            }

            @page {
                margin: 0px;
                padding: 0px;
            }

            .logo {
                width: auto;
                height: 60px;
                margin: 10 0 0 0;
                border: 0px solid #ccc
            }

            .header {
                text-align: center;
            }

            .header h1 {
                margin: 0;
                padding: 0;
                font-size: 12pt;
                border: 0px solid #ccc
            }

            .body-content {
                margin: 10px 0 0 0;
                border: 0px solid #ccc
            }

            .barcode {
                text-align: center;
            }

            .name {
                margin-bottom: 10px;
                font-size: 11pt;
                text-align: center;
                font-weight: bold;
            }

            li {
                list-style: none;
                margin: 0;
                padding;
                0;
            }

            ul {
                margin: 0;
                padding;
                0;
            }

            .linea-separador {
                margin: 10px 15px 0 15px;
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

            .resumen li{
                text-align: right;
            }

            .status-pago {
                text-align: center;
                font-weight: bold;
                border: 0px solid #ccc;
            }

            .content-header {
                width: 100%;
                display: inline-block;
                border: 0px solid red;
                height: 80px;
            }

            .content-items{
                width: 100%;
                display: inline-block;
                border: 0px solid red;     
            }
        </style>
    </head>


    <body>
        <div class="header">
            <img class="logo" src="{{ asset(Storage::url($order->seller->upload_logo_invoice)) }}" alt="">
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

            <div class="name">{{ $order->address->name }}</div>

            <ul>
                <li><span class="fw-bold">DNI:</span> {{ $order->address->dni }}</li>
                <li><span class="fw-bold">TELEFONO:</span> {{ $order->address->phone }}</li>
                <li><span class="fw-bold">DIRECCION:</span> {{ $order->address->primary }}</li>
                <li>{{ $order->address->secondary }}</li>
                <li>{{ $order->address->district->name }} -
                    {{ $order->address->district->province->name }} -
                    {{ $order->address->district->province->department->name }}</li>
                <li><span class="fw-bold">REFERENCIA:</span> {{ $order->address->references }}</li>


                <li class="mt-2"><span class="fw-bold">FECHA ENVIO:</span> {{ $order->delivery_date }}</li>
                <li><span class="fw-bold">HORA DE ENVIO:</span> {{ $order->delivery_time_start }}</li>
                <li><span class="fw-bold">MEDIO DE PAGO:</span> {{ $order->delivery_time_end }}</li>
            </ul>
        </div>

        <div class="content-items pt-3 text-center">
            @foreach ($order->items as $item)
                <img class="px-1 pt-1" src="{{ asset(Storage::url($item->content->file_name)) }}" height="85px" alt="">
            @endforeach
        </div>

        <hr class="linea-separador">

        <div class="content-header pt-3">

            <div class="qr px-4">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('https://erp.3b.pe/summary/imprimir/voucher.php?IDVENTA=10813', 'QRCODE') }}"
                    alt="barcode" height="75" width="75" />
            </div>

            <div class="resumen">
                <li>SUBTOTAL: S/. {{ $order->sub_total }}</li>
                <li>DESCUENTOS: S/. {{ $order->descuentos }}</li>
                <li>ENVIO: S/. {{ $order->shipping_cost_buyer }}</li>
                <li><strong style="font-size: 14pt">TOTAL: S/. {{ $order->total_mount}}</strong></li>
            </div>

        </div>

        <hr class="linea-separador">

        <div class="status-pago">
            <h1>PENDIENTE DE PAGO</h1>
        </div>
    </body>

    </html>
</div>
