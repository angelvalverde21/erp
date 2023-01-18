<div class="card border-secondary">

    @if ($order->is_pay())
        <div class="card-header bg-success">
            <i class="fa-solid fa-sack-dollar mr-2"></i> PAGADO
        </div>
    @else
        <div class="card-header bg-secondary">
            <i class="fa-solid fa-sack-dollar mr-2"></i> PENDIENTE DE PAGO
        </div>
    @endif


    <div class="card-body">

        <table class="table">

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
                </tr> --}}
            </tbody>
            <tfoot>
                <tr class="fw-bold" style="font-size: 18pt">
                    <td class="ultimo-td">Total</td>
                    <td class="ultimo-td">:</td>
                    <td class="ultimo-td">S/. {{ $order->total_amount }}</td>
                    {{-- <td></td> --}}
                </tr>
            </tfoot>
        </table>
    </div>

</div>
