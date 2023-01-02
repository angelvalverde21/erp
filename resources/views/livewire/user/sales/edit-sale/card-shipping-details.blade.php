<div>
    <div class="card">

        <div class="card-header">
            <i class="fa-solid fa-file-invoice-dollar mr-2"></i> Detalles de entrega
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Entregado por:</td>
                    <td>{{ $order->delivery_man->name }}</td>
                </tr>

                <tr>
                    <td>Costo cobrado al cliente</td>
                    <td>S/. {{ $order->shipping_cost_buyer }}</td>
                </tr>


                <tr>
                    <td>Costo del transportista</td>
                    <td>S/. {{ $order->shipping_cost_buyer }}</td>
                </tr>



            </table>

        </div>

        <div class="card-footer">
            {{-- Levanta el modal --}}
            <x-user.button-open-modal target="#edit-details-modal" />

        </div>

    </div>

    <x-user.modal title="Fecha de entrega" id="edit-details-modal">

        
        <x-slot name="footer">

        </x-slot>

    </x-user.modal>

    <x-user.modal title="editar transportista" id="editCarrier" size="modal-lg">
        
        
        <x-slot name="footer">

        </x-slot>

    </x-user.modal>

</div>
