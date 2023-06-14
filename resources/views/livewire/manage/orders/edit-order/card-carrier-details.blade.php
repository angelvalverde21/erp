<div>
    <div class="card">

        <div class="card-header">

            <div class="d-flex justify-content-between">
                <div class="title d-flex align-items-cente">
                    <i class="fa-solid fa-truck mr-2"></i> <span>Enviar por:</span>
                </div>
                <x-form.button-open-modal target="#editCarrierOrder" />
            </div>
        </div>
        
        <div class="card-body py-3">

            @if ($order->carrier_address)
            <li><h4>{{ $order->carrier_address->title }}</h4></li>
            <li>{{ $order->carrier_address->name }}</li>
            <li>{{ $order->carrier_address->phone }}</li>
            <li>{{ $order->carrier_address->primary }}</li>
            <li>{{ $order->carrier_address->secondary }}</li>
            <li>{{ $order->carrier_address->district->name }} -
                {{ $order->carrier_address->district->province->name }} -
                {{ $order->carrier_address->district->province->department->name }}</li>
            @else
                No hay courier, debe seleccionar uno
            @endif



        </div>

    </div>

    <x-modal title="editar transportista" id="editCarrierOrder" size="modal-lg">

        @livewire('components.carriers.show-carrier-all', ['order' => $order], key('show-carrier-all-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>


</div>
