<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice # {{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<style>
    ul {
        margin: 0;
        padding: 0;
    }

    li {
        list-style: none;
    }
</style>

<body style="font-family: Arial, Helvetica, sans-serif">


    <div class="container"> 

        <div class="header d-flex justify-content-between">
            <div class="logo">
                @if ($order->store->getOption('upload_logo_invoice'))
                    <img width="250px" class="logo py-2" src="{{ $order->store->getOption('upload_logo_invoice') }}"
                        alt="">
                @else
                    <h1 class="my-3">SU LOGO AQUI</h1>
                @endif
            </div>

            <div class="info-right text-end">
                <h4>ORDEN DE COMPRA #COD: {{ $order->id }}</h4>
                <h6> Aquarella Ropa y Accesorios</h6>
                <h6> LIMA - PERU</h6>
            </div>
        </div>

        <div class="consignatario">

            <div class="p-2" style="background-color: #E1E1E1; font-size: 1.25rem">
                <strong>RECIBE: {{ Str::upper($order->address->name) }}</strong>
            </div>

            <ul class="py-1 px-3">
                <li>DNI: {{ $order->address->dni }}</li>
                <li>TELEFONO: {{ $order->address->phone }}</li>
                <li>DIRECCION: {{ $order->address->primary }}</li>
                <li>
                    {{ $order->address->district->name }} -
                    {{ $order->address->district->province->name }} -
                    {{ $order->address->district->province->department->name }}
                </li>
            </ul>

        </div>

        <div class="delivery-date">
            <div class="p-2" style="background-color: #E1E1E1; font-size: 1.25rem">
                <strong>FECHA Y HORA DE ENTREGA</strong>
            </div>

            <div class="content-delivery-details d-flex justify-content-between align-items-center">
                <ul class="py-1 px-3">
                    <li>FECHA ENTREGA: {{ $order->delivery_date }}</li>
                    <li>MEDIO DE PAGO: {{ $order->payment_method }}</li>
                    <li>HORA DE ENTREGA: {{ $order->delivery_time_start }} - {{ $order->delivery_time_end }}</li>
                    <li>OBSERVACIONES HORARIO: {{ $order->observations_delivery }}</li>
                </ul>

                <div class="barcode">
                    <div class="show">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order->id, 'C39') }}" alt="barcode"
                            height="30" width="300" />
                    </div>
                    <div class="code text-center">
                        <small>#{{ $order->id }}</small>
                    </div>

                </div>

            </div>

        </div>

        <div class="table">
            <table class="table table-striped">
                <thead>
                    <tr class="bg bg-secondary text-white">
                        <td>COD</td>
                        <td>QTY</td>
                        <td>DESCRIPCION</td>
                        <td>TALLA</td>
                        <td class="text-center">PRECIO</td>
                        <td class="text-center">SUB TOTAL</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->content->talla_impresa }}</td>
                            <td class="text-center">S/. {{ $item->content->price }}</td>
                            <td class="text-center">S/. {{ $item->quantity * $item->content->price }}</td>
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>

                    <tr>
                        <td colspan="6">{{ $order->amountToString() }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end py-3"><strong>SUBTOTAL: </strong></td>
                        <td class="text-center py-3">S/. {{ $order->sub_total }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end py-3"><strong>DESCUENTOS: </strong></td>
                        <td class="text-center py-3">S/. {{ $order->descuentos }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end py-3"><strong>ENVIO: </strong></td>
                        <td class="text-center py-3">S/. {{ $order->shipping_cost_buyer }}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end py-3"><strong>TOTAL: </strong></td>
                        <td class="text-center py-3" style="font-size: 2rem">S/.
                            <strong>{{ $order->total_amount }}</strong></td>
                    </tr>


                </tfoot>
            </table>

            {{-- {{ $order->amountToString() }} --}}
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
