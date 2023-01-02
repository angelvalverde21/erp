<div>
    <div class="card">

        <div class="card-header">
            <i class="fa-solid fa-truck mr-2"></i> Detalles del transporte
        </div>
        <div class="card-body py-0">

            <table class="table table-detalle-transporte">
                <tr>
                    <td class="primer-td">Transportista</td>
                    <td class="primer-td">
                        <li class="mb-1">{{ $order->carrier_address->name }}</li>
                        <li class="mb-0">{{ $order->carrier_address->district->name }} -
                            {{ $order->carrier_address->district->province->name }} -
                            {{ $order->carrier_address->district->province->department->name }}</li>
                        <a class="mb-2" href="#" data-toggle="modal" data-target="#editCarrierOrder">Cambiar</a>
                    </td class="primer-td">
                </tr>
                <tr>
                    <td>Entregado por</td>
                    <td><i class="fa-solid fa-person-biking mr-2"></i>{{ $order->delivery_man->name }}</td>
                </tr>
                <tr>
                    <td>Costo del courier</td>
                    <td><i class="fa-solid fa-truck mr-2"></i>S/. {{ $order->shipping_cost_carrier }}</td>
                </tr>
                <tr>
                    <td class="ultimo-td">Costo cobrado al cliente</td>
                    <td class="ultimo-td"><i class="fa-solid fa-user mr-2"></i> S/. {{ $order->shipping_cost_buyer }}</td>
                </tr>
                <tr>
                    <td class="ultimo-td">Medio de pago</td>
                    <td class="ultimo-td">{{ $order->payment_method->name }}</td>
                </tr>
            </table>


        </div>

        <div class="card-footer">
            {{-- Levanta el modal --}}
            <x-user.button-open-modal target="#editCarrierOrderDetails" />

        </div>

    </div>

    <x-user.modal title="editar transportista" id="editCarrierOrder" size="modal-lg">

        @livewire('user.sales.edit-sale.carriers.show-carrier-all', ['order' => $order], key('show-carrier-all-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-user.modal>

    <x-user.modal title="Detalles de envio" id="editCarrierOrderDetails" size="modal-lg">

        @livewire('user.sales.edit-sale.modal-carrier-details', ['order' => $order], key('modal-carrier-details-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-user.modal>

</div>
