<div class="card border-secondary">

    <div class="card-header bg-secondary">
        <i class="fa-solid fa-sack-dollar mr-2"></i> Resumen
    </div>

    <div class="card-body">
    
        <table class="table">

            <tbody>

                <tr>
                    <td class="primer-td">SubTotal</td>
                    <td class="primer-td">:</td>
                    <td class="primer-td">S/.{{ $order->sub_total }}</td>

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

                <tr>
                    
                    <td>Metodo de pago</td>
                    <td>:</td>
                    <td>{{ $order->payment_method->name }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="fw-bold" style="font-size: 18pt">
                    <td class="ultimo-td">Total</td>
                    <td class="ultimo-td">:</td>
                    <td class="ultimo-td">S/. {{ $order->total_mount }}</td>
                    {{-- <td></td> --}}
                </tr>
            </tfoot>
        </table>
    </div>
   
</div>