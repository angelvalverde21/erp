<div>

    <x-breadcrumbs title="Crear Album" />

    <x-sectioncontent>

        <div class="card">
            <div class="card-body">
                <form action="#">

                    <div class="form-body">

                        <div class="row p-t-20">

                            <div class="col-md-12">
                                <x-form.input type="text" wirevalue="album.name" debounce="500"
                                    error="Este campo es requerido">
                                    Nombre de Album
                                </x-form.input>
                            </div>


                            <x-form.select wirevalue="album.modelo_id" icon="fa-solid fa-user">

                                <option value="">Escoger</option>

                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo->id }}">{{ $modelo->name }}</option>
                                @endforeach

                            </x-form.select>

                            <!--/span-->
                            <div class="col-md-12">
                                <x-form.textarea wirevalue="album.description" error="Este campo es requerido">
                                    Descripcion
                                </x-form.textarea>
                            </div>
                            <!--/span-->

                            {{-- buscador de locaciones --}}
{{-- 
                            <div class="buscardor-location">

                                <div class="buscador-location d-flex justify-content-between">
                                    <div class="input-group me-2">
                                        <input onclick="this.select();" wire:model.debounce.250ms="namelocation"
                                            type="text" class="form-control" placeholder="Buscar locaciones"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text" id="basic-addon2">
                                            <a href="#" wire:click.prevent="deleteSearch()"><i
                                                    class="fa-solid fa-xmark"></i></a>

                                        </span>
                                    </div>
                                    <button wire:click="new" type="button"
                                        class="btn btn-primary d-flex justify-content-between align-items-center"><i
                                            class="fa-solid fa-file me-1"></i><span>Nuevo</span> </button>
                                </div>


                                <div class="mb-3">

                                    <div class="list-group">

                                        @if (is_array($locations) || is_object($locations))

                                            @foreach ($locations as $location)
                                                <button type="button" wire:click="locationAdd('{{ $location->id }}')"
                                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                                                    <span>{{ $location->name }}
                                                        - {{ $location->district->name }}</span>
                                                    <span class="btn btn-success">Escoger</span>
                                                </button>
                                            @endforeach

                                        @endif

                                    </div>

                                </div>

                            </div> --}}

                            {{-- fin de buscador de locaciones --}}

                        </div>

                        <div class="row mb-3">
                                <div class="col">
                                    {{-- @include('livewire.components.locations.show-locations') --}}
                                    @livewire('components.locations.show-locations', 'show-location')
                                </div>
                        </div>

                    </div>

                </form>

                <div class="botones">
                    <div class="form-actions">
                        <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="save"
                            class="btn btn-success"> <i class="fa fa-check"></i> Crear
                            Album</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                    <div wire:loading wire:target="save" class="spinner-borderx" role="status">
                        <span class="sr-onlyx">Espere...</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- @livewire('components.locations.create-location', ['album' => $album, 'reloadUrl' => true], 'location-album-' . $album->id) --}}

    </x-sectioncontent>

</div>
