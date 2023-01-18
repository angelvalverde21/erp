<div>

    {{-- user.sales.edit-sale.addresses.show-address-default --}}
    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <i class="fa-solid fa-house mr-2"></i> Direccion de envio
                </div>
                <x-user.button-open-modal target="#show-all-address-modal" />
            </div>
        </div>
        
        <div class="card-body">

            <li>
                <h4>{{ $address->title }}</h4>
            </li>
            <li>{{ $address->name }}</li>
            <li>DNI: {{ $address->dni }}</li>
            <li>{{ $address->primary }}</li>
            <li>{{ $address->secondary }}</li>
            <li>{{ $address->references }}</li>
            <li>{{ $address->district->name }} -
                {{ $address->district->province->name }} - Dpto.
                {{ $address->district->province->department->name }}</li>
            <li>CEL: {{ $address->phone }}</li>

        </div>

        <!-- Modal content de Address All-->

        <x-modal id="show-all-address-modal" title="Agregar o editar direccion">

            @livewire('components.addresses.show-address-all', ['user' => $address->user_id, 'model_refer' => $this->model_refer, 'model_refer_id' => $this->model_refer_id], key('show-addresses-all-' . $address->user_id))

        </x-modal>

        <script>
            window.addEventListener('closeModal', event => {
                $('#show-all-address-modal').modal('hide');
                console.log('modal cerrado');
            })
        </script>

    </div>

</div>
