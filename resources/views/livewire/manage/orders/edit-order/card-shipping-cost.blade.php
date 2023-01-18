<div>
    <div class="card">

        <div class="card-header">
            <x-form.button-open-modal target="#editCarrierOrderDetails" />
        </div>


        <div class="card-body">

            <table class="table table table-striped">

                {{-- <tr>
                    <td>Trasladado por</td>
                    <td><i class="fa-solid fa-person-biking mr-2"></i>{{ $order->delivery_man->name }}</td>
                </tr> --}}
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
                {{-- <tr>
                    <td class="ultimo-td">Medioxx de pago</td>
                    <td class="ultimo-td">{{ $order->payment_list->name }}</td>
                </tr> --}}
            </table>

        </div>

    </div>

    <x-modal title="Detalles de envio" id="editCarrierOrderDetails" size="modal-lg">

        @livewire('manage.orders.edit-order.modal-carrier-details', ['order' => $order], key('modal-carrier-details-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>

</div>
