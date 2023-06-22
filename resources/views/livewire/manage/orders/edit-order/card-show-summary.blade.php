<div>
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
    
    
</div>