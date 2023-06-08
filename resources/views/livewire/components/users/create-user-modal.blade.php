<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-sale-modal-{{ $rol }}">
        <i class="fa-solid fa-clipboard-check mr-1"></i> Nuevo usuario
    </button>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-sale-modal-{{ $rol }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ingresar Usuario ( {{ $rol }} )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-6">
                            <x-form.input type="number" debounce="500" wirevalue="phone" icon="fa-solid fa-phone" error="Este campo es requerido">
                                Celular
                            </x-form.input>
                        </div>

                        <div class="col-lg-6 col-6">
                            <x-form.input type="number" debounce="500" wirevalue="dni" icon="fa-solid fa-id-badge" error="Este campo es requerido">
                                DNI
                            </x-form.input>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <x-form.input type="text" debounce="500" wirevalue="name" icon="fa-solid fa-user" error="Este campo es requerido">
                                Nombre completo
                            </x-form.input>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <x-form.input type="text" debounce="500" wirevalue="primary" icon="fa-solid fa-dolly" error="Este campo es requerido">
                                Direccion principal
                            </x-form.input>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-form.input type="text" debounce="500" wirevalue="secondary">
                                Direccion secundaria
                            </x-form.input>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <x-form.input type="text" debounce="500" wirevalue="references" icon="fa-solid fa-right-long" error="Este campo es requerido">
                                Referencia
                            </x-form.input>
                        </div>

                    </div>

                    {{-- inicio de buscador de distritos --}}
                    
                    <style>
                        .resultados ul {
                            margin: 0 !important;
                            padding: 0 10px !important;
                        }

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
                                <input type="text" autocomplete="off" class="form-control" id="inputDistrict" debounce="250" wire:model="namedistrict"
                                    aria-describedby="nameHelp" placeholder="Distrito">

                                <input type="hidden" class="form-control" id="inputDistrict"
                                    wire:model="district_id">
                                @error('district_id')
                                    <span class="error">Debe escoger un distrito</span>
                                @enderror

                                <div class="resultados">
                                    <ul>
                                       
                                            @foreach ($districts as $district)
                                                <li><a href="#"
                                                        wire:click.prevent="$emit('districtAdded','{{ $district->id }}')">{{ $district->name }} - {{ $district->province->name }} - Dpto. {{ $district->province->department->name }}</a>
                                                </li>
                                            @endforeach
                                       
                                    </ul>
                                </div>


                            </div>
                        </div>

                    </div>
                    
                    {{-- fin de buscador de distritos --}}

                </div>

                <div class="modal-footer">
                    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                        wire.target="save" wire:click="save" class="btn btn-info ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>Guardar Cambios</button>

                    <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>


</div>
