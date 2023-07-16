<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            width: 180px;
            max-height: 60px;
            margin: 10 0 10px 0;
            border: 0px solid #ccc
        }

        .header {
            text-align: center;
            position: relative;
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
            height: 2px;
            border-color: #000000;
        }

        /* .qr {
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
        } */

        .resumen li {
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
            height: 110px;
        }

        .content-items {
            width: 100%;
            display: inline-block;
            border: 0px solid red;
        }

        .pagado {
            position: absolute;
            top: 200px;
            left: 75px;
            opacity: 0.5;
        }

        .content-qr {
            float: left;
        }

        .resumen {
            float: right;
        }
    </style>
</head>

<body>

    <div class="pagado">
        @if ($order->is_pay())
            <img class="px-1 pt-1" src="{{ asset(Storage::url('orders/pagado.png')) }}" height="250px" alt="">
        @endif
    </div>
    <div class="header">

        {{-- OJO EN EL PDF SE DEBE USAR LA RUTA COMPLETA, POR ESO SE USA ASSETS --}}

        @if ($order->store->getOption('upload_logo_invoice'))
            <img class="logo" src="{{ $order->store->getOption('upload_logo_invoice') }}" alt="">
        @else
            <h1 class="my-5">SU LOGO AQUI</h1>
        @endif


        <h1 class="name">ORDEN DE COMPRA: #{{ $order->id }}</h1>
        {{-- <small style="padding: 0 10px">
            Aquarella Ropa y Accesorios, Tienda 100% Online Open 24/7,
            compra y recibe en casa en menos de 24 Horas

        </small> --}}
        <hr class="linea-separador">
    </div>

    <div class="body-content">

        <div class="barcode">
            {{-- Si desaparece el codigo de barras, verificar que este activo el gd en el php.ini en la linea extension=gd  --}}
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG('2561465165024', 'C39') }}" alt="barcode"
                height="40" width="300" />

            <small>2561465165024</small>
        </div>

        <style>
            .ficha {
                margin: 0 15px;
            }
        </style>

        <div class="name">{{ strtoupper($order->address->name) }}</div>

        <div class="ficha" style="margin: 0: padding: 0">
            <li><span class="fw-bold">DNI:</span> {{ $order->address->dni }}</li>
            <li><span class="fw-bold">TELEFONO:</span> {{ $order->address->phone }}</li>
            <li><span class="fw-bold">DIRECCION:</span> {{ strtoupper($order->address->primary) }}</li>
            <li>{{ $order->address->secondary }}</li>
            <li>{{ $order->address->district->name }} -
                {{ $order->address->district->province->name }} -
                {{ $order->address->district->province->department->name }}</li>
            <li><span class="fw-bold">REFERENCIA:</span> {{ strtoupper($order->address->references) }}</li>


            <li class=""><span class="fw-bold">FECHA ENVIO:</span> {{ $order->delivery_date }}</li>
            {{-- <li><span class="fw-bold">HORA DE ENVIO:</span> {{ $order->delivery_time_start }}</li>
            <li><span class="fw-bold">MEDIO DE PAGO:</span> {{ $order->delivery_time_end }}</li> --}}
            </ul>
        </div>

        <div class="content-items pt-3 text-center">
            @foreach ($order->items as $item)
                <img class="px-1 pt-1" src="{{ asset(Storage::url($item->content->image)) }}" height="85px"
                    alt="">
            @endforeach
        </div>

        <hr class="linea-separador">

        <div class="content-header pt-2">

            <div class="content-qr">

                @if ($order->store->getOption('code_yape'))
                    <div class="qr text-center w-100">
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($order->store->getOption('code_yape'), 'QRCODE') }}"
                            alt="barcode" height="100" width="100" />
                    </div>
                    <div class="w-100 text-center"> Yape </div>
                @else
                    <div class="logo_temp p-3">
                        <img src="{{ asset(Storage::url('upload_qr_temp.jpg')) }}" alt="barcode" height="100"
                            width="100" />
                    </div>

                    {{-- <style>
                        .qr_temp .marco{
                            width: 100px;
                            height: 100px;
                            border: 5px solid #000000;
                            border-radius: 10px
                        }
                    </style>

                    <div class="qr_tem">
                        <div class="marco">
                            <h1>Su Qr Aqui</h1>
                        </div>
                    </div> --}}
                @endif


                {{-- <label>{{ $order->store->wallet->yape }}</label>
                <label>{{ $order->store->wallet->titular_yape }}</label> --}}
            </div>

            <div class="resumen">
                <li>SUBTOTAL: S/. {{ $order->sub_total }}</li>
                @if ($order->descuentos > 0)
                    <li>DESCUENTOS: S/. {{ $order->descuentos }}</li>
                @endif

                @if ($order->shipping_cost_buyer > 0)
                    <li>ENVIO @if ($order->is_contra_entrega())
                            (Motorizado)
                        @endif: S/. {{ $order->shipping_cost_buyer }}</li>
                @else
                    <li>ENVIO: GRATIS</li>
                @endif
                <li>------------------------------------</li>
                <li><strong style="font-size: 14pt">TOTAL: S/. {{ $order->total_amount }}</strong></li>
            </div>


        </div>

        <hr>
        <div class="transporte ">

            <div class="text-center">
                Se transportara por: {{ $order->carrier_address->name }}
            </div>
            <div class="logo w-100 text-center">
                <img src="{{ $order->carrier_address->user->getOption('logo_profile') }}" height="50px">
            </div>

            @switch($order->delivery_method_id)
                @case(1)

                @break

                @case(2)
                    <h1 class="w-100 text-center">RECOJO EN TIENDA</h1>
                @break

            @endswitch


        </div>

        @if (!$order->is_pay())

            <hr class="linea-separador my-3">

            <div class="status-pago">
                <h1>PENDIENTE DE PAGO</h1>
                @if ($order->is_contra_entrega())
                    <h2>(CONTRA ENTREGA)</h2>
                @endif

            </div>

        @endif
</body>

</html>
