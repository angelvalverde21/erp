<div>
    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-calendar mr-2"></i> Fecha de entrega
        </div>
        <div class="card-body">
            <table class="table">

                <tr>
                    <td class="primer-td">Fecha de entrega:</td>
                    <td class="primer-td"><i class="fa-solid fa-calendar-days mr-2"></i> {{ $order->delivery_date }}</td>
                </tr>
                <tr>
                    <td>Horario:</td>
                    <td><i class="fa-solid fa-clock"></i> De {{ $order->delivery_time_start }} Hasta {{ $order->delivery_time_end }}</td>
                </tr>
                <tr>
                    <td class="ultimo-td">Observaciones:</td>
                    <td class="ultimo-td">{{ $order->observations_time }}</td>
                </tr>
                {{-- <tr>
                    <td class="ultimo-td">Observaciones:</td>
                    <td class="ultimo-td">{{ $order->messagenCalendar }}</td>
                </tr> --}}
                {{-- <tr>
                    <td>Tipo de entrega:</td>
                    <td>{{ $order->delivery_method->name }}</td>
                </tr>
                <tr>
                    <td>Metodo de pago:</td>
                    <td>{{ $order->payment_method->name }}</td>
                </tr> --}}

            </table>

        </div>

        <div class="card-footer">
            {{-- Levanta el modal --}}
            <x-user.button-open-modal target="#modal-date-edit-details" />

        </div>

    </div>

    <x-modal title="Fecha de entrega" id="modal-date-edit-details">

        @livewire('manage.orders.edit-order.modal-date-details', ['order' => $order], key('modal-date-edit-details-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>


</div>
