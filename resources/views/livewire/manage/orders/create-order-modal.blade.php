<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-sale-modal">
        <i class="fa-solid fa-clipboard-check mr-1"></i> Nueva venta
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-sale-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ingresar pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Current (Gps) --}}
                @push('script')
                    <script>
                        // enviando datos al servidor
                        document.addEventListener('livewire:load', function() {
                            @this.current = current;
                            console.log(current);
                        })
                    </script>
                @endpush

                {{-- Crear Orden con nuevo usuario --}}

                @if ($existe_usuario)

                    {{-- si existe usuario --}}

                    <div class="modal-body">

                        <div class="alert alert-warning" role="alert">
                            El usuario ya existe
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('manage.customers.edit', [$store->nickname, $user->id]) }}"
                                    class="btn btn-secondary">Ver Pedidos</a>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <li>Nombre: {{ $user->name }} {{ $user->lastname }}</li>
                                    <li>DNI: {{ $user->dni }}</li>
                                    <li>Telefono: {{ $user->phone }}</li>
                                </ul>
                            </div>
                        </div>

                        {{-- @if ($have_address)
                            @livewire('components.addresses.show-address', ['address' => $user->address_id, 'model_refer' => 'User', 'model_refer_id' => $user->id], key('show-address-' . $user->id))
                        @else
                            @livewire('components.addresses.show-address-all', ['user' => $user->id, 'model_refer' => 'User', 'model_refer_id' => $user->id], key('show-addresses-all-' . $user->id))
                        @endif --}}

                        @livewire('components.addresses.show-address-all', ['user' => $user->id, 'model_refer' => 'User', 'model_refer_id' => $user->id, 'render' => 'actualizarUsuario'], key('show-addresses-all-' . $user->id))


                    </div>

                    @if ($user->addresses->count())
                        <div class="modal-footer">

                            <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                                wire.target="crearVentaUsuarioExistente"
                                wire:click="crearVentaUsuarioExistente({{ $user->id }})"
                                class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>Crear Nueva
                                Venta ({{ $user->name }})</button>

                            <div class="spinner-border" wire:loading.flex wire:target="crearVentaUsuarioExistente"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        </div>
                    @endif

                    {{-- si existe usuario FIN --}}
                @else
                    {{-- si NO existe usuario --}}

                    <div class="modal-body">

                        <div class="row">

                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-6">
                                <x-form.input debounce="500" type="number" wirevalue="phone" icon="fa-solid fa-phone"
                                    error="Este campo es requerido">
                                    Celular
                                </x-form.input>
                            </div>

                            <div class="col-lg-6 col-6">
                                <x-form.input debounce="500" type="number" wirevalue="dni" icon="fa-solid fa-id-badge"
                                    error="Este campo es requerido">
                                    DNI
                                </x-form.input>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <x-form.input debounce="500" type="text" wirevalue="name" icon="fa-solid fa-user"
                                    error="Este campo es requerido">
                                    Nombre completo
                                </x-form.input>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-12">
                                <x-form.input debounce="500" type="text" wirevalue="primary" icon="fa-solid fa-dolly"
                                    error="Este campo es requerido">
                                    Direccion principal
                                </x-form.input>
                            </div>

                            <div class="col-lg-6 col-12">
                                <x-form.input debounce="500" type="text" wirevalue="secondary">
                                    Direccion secundaria
                                </x-form.input>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <x-form.input debounce="500" type="text" wirevalue="references" icon="fa-solid fa-right-long"
                                    error="Este campo es requerido">
                                    Referencia
                                </x-form.input>
                            </div>

                        </div>

                        {{-- inicio de buscador de distritos --}}

                        <style>
                            .resultados {
                                box-shadow: -2px 3px 24px 0px rgba(163, 163, 163, 1);
                            }

                            .resultados ul li {
                                border-bottom: 1px solid #ccc;
                                padding-bottom: 3px;
                            }
                        </style>

                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <div class="mb-3">
                                    <input type="text" autocomplete="off" class="form-control" id="inputDistrict"
                                        wire:model.debounce.500ms="namedistrict" aria-describedby="nameHelp" placeholder="Distrito">

                                    <input type="hidden" class="form-control" id="inputDistrict"
                                        wire:model="district_id">
                                    @error('district_id')
                                        <div class="has-danger">
                                            <span class="error">Debe escoger un distrito</span>
                                        </div>
                                    @enderror

                                    <div class="resultados">

                                        <ul class="list-group">

                                            @foreach ($districts as $district)
                                                <li class="list-group-item">
                                                    <a href="#"
                                                        wire:click.prevent="$emit('districtAdded','{{ $district->id }}')">{{ $district->name }}
                                                        - {{ $district->province->name }} - Dpto.
                                                        {{ $district->province->department->name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>


                                </div>
                            </div>



                            {{-- <div class="col-lg-6 col-12">
                                <x-form.select wirevalue="delivery_method_id" icon="fa-solid fa-truck"
                                    error="Debe Elegir un metodo de entrega">
                                    <option value="">Escoger</option>
                                    @foreach (deliveryMethods() as $delivery_method)
                                        <option value="{{ $delivery_method->id }}">
                                            {{ $delivery_method->title }}</option>
                                    @endforeach
                                </x-form.select>

                            </div> --}}


                            {{-- <div class="col-lg-6 col-12">
                                <x-form.select label="" wirevalue="delivery_man_id"
                                    icon="fa-solid fa-person-biking"
                                    error="Debe Elegir la persona que entregara el paquete">
                                    <option value="">Escoger</option>
                                    @foreach (repartidores() as $repartidor)
                                        <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                            </div> --}}


                            {{-- <div class="col-lg-12 col-12">
                            <x-form.select wirevalue="payment_method_id" icon="fa-solid fa-receipt"
                                error="Debe elegir el metodo de pago del cliente">

                                @foreach (paymentMethods() as $paymentList)


                                    <option value="{{ $paymentList->id }}">
                                        {{ $paymentList->name }}</option>
                                @endforeach

                            </x-form.select>

                        </div> --}}


                            <div class="col-lg-12 col-12">

                                <x-form.select id="payment_method_id" label="Metodo de pago"
                                    wirevalue="payment_method_id" icon="fa-solid fa-money-bill-1-wave">

                                    <option value="">Escoger</option>

                                    @foreach (paymentMethods() as $paymentMethod)
                                        <option value="{{ $paymentMethod->id }}"> {{ $paymentMethod->name }}</option>

                                        @foreach ($paymentMethod->paymentMethodChildrens as $paymentMethodChildren)
                                            @include(
                                                'livewire.manage.orders.edit-order._navbar-pay-method-child',
                                                [
                                                    'parent_name' => $paymentMethod->name,
                                                    'child' => $paymentMethodChildren,
                                                    'separador' => '--',
                                                ]
                                            )
                                        @endforeach
                                    @endforeach

                                </x-form.select>

                            </div>

                        </div>

                        {{-- fin de buscador de distritos --}}

                    </div>

                    <div class="modal-footer">
                        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                            wire.target="save" wire:click="save" class="btn btn-info ml-auto"><i
                                class="fa-solid fa-floppy-disk mr-1"></i>Guardar Cambios</button>

                        <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>

                    {{-- si NO existe usuario --}}

                @endif

                {{-- Fin de Crear Orden con nuevo usuario --}}

            </div>
        </div>
    </div>


</div>
