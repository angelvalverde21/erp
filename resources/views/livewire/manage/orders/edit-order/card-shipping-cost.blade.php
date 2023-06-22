<div>

    <ul class="list-group mb-3">

        <li class="list-group-item  list-group-item-dark d-flex justify-content-between align-items-center">
            <span><h6><i class="fa-solid fa-comments-dollar me-2"></i> Gastos de envio</h6></span>
            <div class="controls">
                <x-form.button-open-modal target="#editCarrierOrderDetails" mr="0"/>
            </div>
        </li>

        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">Costo de envio</h6>
                <small class="text-muted">Costo que ha pagodo el cliente</small>
            </div>
            <span class="text-muted">S/. {{ $order->shipping_cost_buyer }}</span>
        </li>

        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">Translado</h6>
                <small class="text-muted">Pasajes y taxis para envio</small>
            </div>
            <span class="text-muted">S/. {{ $order->shipping_cost_to_carrier }}</span>
        </li>

        <li class="list-group-item d-flex justify-content-between">
            <div>
                <h6 class="my-0">Gasto envio</h6>
                <small class="text-muted">Costo que cobra la agencia</small>
            </div>
            <span class="text-muted">S/. {{ $order->shipping_cost_carrier }}</span>
        </li>

        <li class="list-group-item d-flex justify-content-between">
            <div>
                
            </div>
            <div>
                <span>S/. {{ $order->shipping_cost_buyer - $order->shipping_cost_to_carrier - $order->shipping_cost_carrier }}</span>
            </div>
        </li>

    </ul>

    {{-- <div class="card">

        <div class="card-header">

        </div>


        <div class="card-body">

            <table class="table table table-striped">

                <tr>
                    <td class="ultimo-td"><i class="fa-solid fa-user mr-2"></i> Costo cobrado al cliente</td>
                    <td class="ultimo-td">S/. {{ $order->shipping_cost_buyer }}</td>
                </tr>

                <tr>
                    <td><i class="fa-solid fa-person-biking mr-2"></i> Costo de translado a oficina courier</td>
                    <td>- S/. {{ $order->shipping_cost_to_carrier }}</td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-truck mr-2"></i> Costo del courier</td>
                    <td>- S/. {{ $order->shipping_cost_carrier }}</td>
                </tr>

                <tr>
                    <td class="ultimo-td fw-bold">Saldo</td>
                    <td class="ultimo-td fw-bold">S/. {{ $order->shipping_cost_buyer - $order->shipping_cost_to_carrier - $order->shipping_cost_carrier }}</td>
                </tr>

            </table>

        </div>

    </div> --}}

    <x-modal title="Costos de:" id="editCarrierOrderDetails" size="modal-lg">

        @livewire('manage.orders.edit-order.modal-carrier-details', ['order' => $order], key('modal-carrier-details-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>

</div>
