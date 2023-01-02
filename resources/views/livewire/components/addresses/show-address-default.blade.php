<div>

    {{-- user.sales.edit-sale.addresses.show-address-default --}}
    <div class="card">
    
        <div class="card-header">
            <i class="fa-solid fa-house mr-2"></i> Direccion de envio
        </div>
        <div class="card-body">
            <ul>
                <li>{{ $user->address->name }}</li>
                <li>DNI: {{ $user->address->dni }}</li>
                <li>{{ $user->address->primary }}</li>
                <li>{{ $user->address->secondary }}</li>
                <li>{{ $user->address->references }}</li>
                <li>{{ $user->address->district->name }} -
                    {{ $user->address->district->province->name }} - Dpto.
                    {{ $user->address->district->province->department->name }}</li>
                <li>CEL: {{ $user->address->phone }}</li>
            </ul>
        </div>
    
        <div class="card-footer">
    
            <x-user.button-open-modal target="#show-all-address-modal" />
    
        </div>
    
        <!-- Modal content de Address All-->
    
        <x-modal id="show-all-address-modal" title="Agregar o editar direccion">
    
            @livewire('components.addresses.show-address-all', ['order' => $user->id], key('show-addresses-all-' . $user->address->user_id))
    
        </x-modal>
    
    </div>
    
</div>