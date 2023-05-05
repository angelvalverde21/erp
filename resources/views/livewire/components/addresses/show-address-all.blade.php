<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    @push('script')
        <script>
            $(document).ready(function() {
                $('#btn-add-new-address').on('click', function() {
                    var text = $('#btn-add-new-address').text();
                    if (text === 'Agregar nuevo') {
                        $(this).text('Cancelar');
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-secondary');
                    } else {
                        $(this).text('Agregar nuevo');
                        $(this).removeClass('btn-secondary');
                        $(this).addClass('btn-success');
                    }
                });

                $('.btn-edit-address').on('click', function() {
                    var text = $(this).text();
                    if (text === 'Editar') {
                        $(this).text('Cancelar');
                    } else {
                        $(this).text('Editar');
                    }
                });
            })
        </script>
    @endpush

    {{-- Toggle para agregar nueva direccion --}}

    <div class="card">
        <div class="card-body">
            <a data-bs-toggle="collapse" id="btn-add-new-address" href="#add-new-address" role="button"
                aria-expanded="false" aria-controls="add-new-address" class="btn btn-success">Agregar nuevo</a>


            <div class="collapse" id="add-new-address">
                @livewire('components.addresses.create-address', ['user_id' => $user->id, 'render'=> $render], key('create-addresses-' . $user->id))
            </div>

        </div>
    </div>

    {{-- Mostrando las direcciones en texto plano --}}

    @foreach ($addresses as $address)
        {{-- <p>El address actual es: {{ $address->id }}</p>
        <p>El address selected es: {{ $address_selected }}</p> --}}

        @if ($address->id == $address_selected)
            <div class="card bg-light" wire:key="card-{{ $address->id }}">
        @else
            <div class="card" wire:key="card-{{ $address->id }}">
        @endif
                <div class="card-body">

                    <li><h3>{{ $address->title }}</h3></li>
                    <li>{{ $address->name }}</li>
                    <li>DNI: {{ $address->dni }}</li>
                    <li>{{ $address->primary }}</li>
                    <li>{{ $address->secondary }}</li>
                    <li>{{ $address->references }}</li>
                    <li>{{ $address->district->name }} -
                        {{ $address->district->province->name }} - Dpto.
                        {{ $address->district->province->department->name }}</li>
                    <li>CEL: {{ $address->phone }}</li>
                    <li class='d-block mt-3'>
                        <a data-bs-toggle="collapse" class="btn btn-light btn-edit-address "
                            href="#edit-address-{{ $address->id }}" role="button" aria-expanded="false"
                            aria-controls="edit-address-{{ $address->id }}">Editar</a>

                        @if ($address->id == $address_selected)
                        @else
                            <a class="btn btn-light" href="#" role="button"
                                wire:click.prevent="selectAddress('{{ $address->id }}')">Seleccionar</a>
                        @endif

                    </li>


                    {{-- Editor de la direccion --}}
                    <div class="collapse" id="edit-address-{{ $address->id }}">

                        @if ($address->id == $address_selected)
                            {{-- El parametro selected es opcional, por defecto se envia false (revisar el componente edit-address) --}}
                            @livewire('components.addresses.edit-address', ['address' => $address->id, 'selected' => 1], key('edit-address-single-true-' . $address->id))
                        @else
                            @livewire('components.addresses.edit-address', ['address' => $address->id, 'selected' => 0], key('edit-address-single-false-' . $address->id))
                        @endif

                    </div>
                    {{-- Fin de Editor de la direccion --}}

                </div>
            </div>
    @endforeach

@push('script')
    <script>
        Livewire.on('select_address', function() {
            Swal.fire(
                'Seleccionado!',
                'Se ha actualizado la orden',
                'success'
            )
        });
    </script>
@endpush
</div>
