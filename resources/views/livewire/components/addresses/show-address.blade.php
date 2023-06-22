<div>

    {{-- user.sales.edit-sale.addresses.show-address-default --}}

    <ul class="list-group mb-3">
        {{-- <li class="list-group-item">
            <h4>{{ $address->title }}</h4>
        </li> --}}
        <li class="list-group-item  list-group-item-dark d-flex justify-content-between align-items-center">
            <span><h6><i class="fa-solid fa-user me-2"></i> Direccion de envio</h6></span>
            <div class="controls">
                <x-user.button-open-modal target="#show-all-address-modal" />
            </div>
        </li>
        <li class="list-group-item"><h5>{{ $address->name }}</h5></li>
        <li class="list-group-item">DNI: {{ $address->dni }}</li>
        <li class="list-group-item">{{ $address->primary }}</li>
        <li class="list-group-item">{{ $address->secondary }}</li>
        @if ($address->references != '')
            <li class="list-group-item">{{ $address->references }}</li>
        @endif
        <li class="list-group-item">{{ $address->district->name }} -
            {{ $address->district->province->name }} - Dpto.
            {{ $address->district->province->department->name }}</li>
        <li class="list-group-item">CEL: {{ $address->phone }}</li>
    </ul>
    
    {{-- <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="title">
                    <i class="fa-solid fa-house mr-2"></i> Direccion de envio
                </div>
                
            </div>
        </div>

        <div class="card-body">



        </div>


    </div> --}}

    
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
