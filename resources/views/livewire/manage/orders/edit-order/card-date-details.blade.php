<div>

    <ul class="list-group mb-3">
        {{-- <li class="list-group-item">
            <h4>{{ $address->title }}</h4>
        </li> --}}

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>
                <strong>Fecha de entrega:</strong> 
                @if ($order->MessagenCalendar != '')
                    {{ $order->delivery_date }} ({{ $order->MessagenCalendar }})
                @else
                    {{ $order->delivery_date }}
                @endif
            </span>
            <div class="controls">
                <x-user.button-open-modal target="#modal-date-edit-details" />
            </div>
        </li>


        <li class="list-group-item d-flex justify-content-between">
            <span>Hora:</span>
            <div class="data">
                De {{ $order->delivery_time_start }} Hasta {{ $order->delivery_time_end }}
            </div>
        </li>

        @if ($order->observations_time != '')
            <li class="list-group-item d-flex justify-content-between">
                <span>Observaciones:</span>
                <div class="data text-end">
                    {{ $order->observations_time }}
                </div>
            </li>
        @endif



    </ul>


    {{-- <div class="card">
        <div class="card-header">

            <div class="d-flex justify-content-between">
                <div class="title">
                    <i class="fa-solid fa-calendar mr-2"></i> Fecha de entrega
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">

                <tr>
                    <td class="primer-td"></td>
                    <td class="primer-td"><i class="fa-solid fa-calendar-days mr-2"></i>Fecha de entrega: {{ $order->delivery_date }}</td>
                </tr>
                <tr>
                    <td>Horario:</td>
                    <td><i class="fa-solid fa-clock"></i> De {{ $order->delivery_time_start }} Hasta {{ $order->delivery_time_end }}</td>
                </tr>
                <tr>
                    <td class="ultimo-td">Observaciones:</td>
                    <td class="ultimo-td">{{ $order->observations_time }}</td>
                </tr>

            </table>

        </div>

    </div> --}}

    <x-modal title="Fecha de entrega" id="modal-date-edit-details">

        @livewire('manage.orders.edit-order.modal-date-details', ['order' => $order], key('modal-date-edit-details-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>


</div>
