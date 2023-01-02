<div class="card">

    <div class="card-header">
        Direccion de envio
    </div>
    <div class="card-body">
        <ul>
            <li>{{ $address->name }}</li>
            <li>DNI: {{ $address->dni }}</li>
            <li>{{ $address->primary }}</li>
            <li>{{ $address->secondary }}</li>
            <li>{{ $address->references }}</li>
            <li>{{ $address->district->name }} -
                {{ $address->district->province->name }} - Dpto.
                {{ $address->district->province->department->name }}</li>
            <li>CEL: {{ $address->phone }}</li>
        </ul>
    </div>

    <div class="card-footer">
        @livewire('user.components.addresses.show-address-all-modal', ['user_id' => $address->user_id], key('show-addresses-all-modal-' . $address->user_id))
    </div>

</div>