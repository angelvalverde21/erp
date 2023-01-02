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

    <div class="card">
        <div class="card-body">
            <a data-bs-toggle="collapse" id="btn-add-new-address" href="#add-new-address" role="button" aria-expanded="false"
                aria-controls="add-new-address" class="btn btn-success">Agregar nuevo</a>


            <div class="collapse" id="add-new-address">
                @livewire('user.components.addresses.create-address', ['user_id' => $user_id], key('create-addresses-' . $user_id))
            </div>
        </div>
    </div>

    {{-- Mostrando las direcciones en texto plano --}}

    @foreach ($addresses as $address)

        <div class="card">
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
                    <li><a data-bs-toggle="collapse" class="btn-edit-address" href="#edit-address-{{ $address->id }}" role="button"
                            aria-expanded="false" aria-controls="edit-address-{{ $address->id }}">Editar</a></li>
                </ul>

                {{-- Editor de la direccion --}}
                <div class="collapse" id="edit-address-{{ $address->id }}">
                    <hr>
                    @livewire('user.components.addresses.edit-address', ['address' => $address], key('edit-address-single-' . $address->id))
                </div>
                {{-- Fin de Editor de la direccion --}}

            </div>
        </div>

    @endforeach
</div>
