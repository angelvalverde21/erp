<div>

{{-- user.sales.edit-sale.addresses.show-address-default --}}
<div class="card">

    <div class="card-header">
        <i class="fa-solid fa-house mr-2"></i> Direccion de envio
    </div>
    <div class="card-body">
        <ul>
            <li>{{ $order->address->name }}</li>
            <li>DNI: {{ $order->address->dni }}</li>
            <li>{{ $order->address->primary }}</li>
            <li>{{ $order->address->secondary }}</li>
            <li>{{ $order->address->references }}</li>
            <li>{{ $order->address->district->name }} -
                {{ $order->address->district->province->name }} - Dpto.
                {{ $order->address->district->province->department->name }}</li>
            <li>CEL: {{ $order->address->phone }}</li>
        </ul>
    </div>

    <div class="card-footer">

        <x-user.button-open-modal target="#show-all-address-modal" />

    </div>

    <!-- Modal content de Address All-->

    <x-modal id="show-all-address-modal" title="Agregar o editar direccion orden">

        @livewire('user.sales.edit-sale.addresses.show-address-all', ['order' => $order->id], key('show-addresses-all-' . $order->address->user_id))

    </x-modal>

</div>

</div>