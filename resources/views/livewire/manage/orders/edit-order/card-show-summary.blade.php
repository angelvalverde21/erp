<ul class="list-group mb-3">

    @if ($order->is_pay())

        <li class="list-group-item d-flex justify-content-between lh-condensed bg-success">
            <div>
                <h6 class=""><i class="fa-solid fa-sack-dollar mr-2"></i></h6>
            </div>
            <h6 class="text-white">PAGADO</h6>
        </li>
    @else
        <li class="list-group-item d-flex justify-content-between lh-condensed bg-secondary">
            <div>
                <h6 class=""><i class="fa-solid fa-sack-dollar mr-2"></i></h6>
            </div>
            <h6 class="text-white"> PENDIENTE DE PAGO</h6>
        </li>
    @endif


    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">Sub Total</h6>
            {{-- <small class="text-muted">Brief description</small> --}}
        </div>
        <span class="text-muted">S/. {{ $order->sub_total }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">Impuestos</h6>
            <small class="text-muted">IGV (18%)</small>
        </div>
        <span class="text-muted">S/. 0,00</span>
    </li>

    @if ($order->descuentos > 0)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">Descuentos</h6>
                {{-- <small class="text-muted">Brief description</small> --}}
            </div>
            <span class="text-muted">S/. {{ $order->descuentos }}</span>
        </li>
    @endif

    <li class="list-group-item d-flex justify-content-between">
        <div>
            <h6 class="my-0">Envio</h6>
            {{-- <small>EXAMPLECODE</small> --}}
        </div>

        <span class="text-success">S/. {{ $order->shipping_cost_buyer }}</span>
    </li>

    @if ($order->is_pay())
        <li class="list-group-item d-flex justify-content-between bg-light text-success">
            <div>
                <h5>Total (USD)</h5>
            </div>
            <h5>S/. {{ $order->total_amount }}</h5>
        </li>
    @else
        <li class="list-group-item d-flex justify-content-between bg-light">
            <div>
                <h5>Total (USD)</h5>
            </div>
            <h5>S/. {{ $order->total_amount }}</h5>
        </li>
    @endif


</ul>

<div class="card border-secondary">



    <div class="card-body">

        {{-- <div class="message mb-3"><h5>Costos cobrado al cliente</h5></div> --}}


        {{-- <table class="table">

            <tbody>

                <tr>
                    <td class="primer-td">SubTotal</td>
                    <td class="primer-td">:</td>
                    <td class="primer-td">S/.{{ $order->sub_total }}</td>
                </tr>

                <tr>
                    <td class="primer-td">Impuestos</td>
                    <td class="primer-td">:</td>
                    <td class="primer-td">S/.0.00</td>
                </tr>

                @if ($order->descuentos > 0)
                    <tr>
                        <td>Cupones o Descuentos</td>
                        <td>:</td>
                        <td>- S/. {{ $order->descuentos }}</td>
                    </tr>
                @endif

                <tr>
                    <td>Envio</td>
                    <td>:</td>
                    <td>S/. {{ $order->shipping_cost_buyer }}</td>
                </tr>

                {{-- <tr>
                    
                    <td>Metodo de pago</td>
                    <td>:</td>
                    <td>{{ $order->payment_list->title }} ( {{ $order->payment_method->title }})</td>
                </tr> 
            </tbody>
            <tfoot>
                <tr class="fw-bold" style="font-size: 18pt">
                    <td class="ultimo-td">Total</td>
                    <td class="ultimo-td">:</td>
                    <td class="ultimo-td">S/. {{ $order->total_amount }}</td>
                </tr>
            </tfoot>
        </table> --}}
    </div>

</div>
