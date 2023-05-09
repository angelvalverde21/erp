<div>
    {{-- Success is as dangerous as failure. --}}

    <a href="#" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#agregarAlbum">Agregar Album</a>

    <x-modal title="Crear Album" id="agregarAlbum" size="modal-lg">
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

                </div>

                {{-- <div class="row mb-3">
                    <div class="col">
                        @include('livewire.components.locations.show-locations')
                    </div>
                </div> --}}



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
    </x-modal>

    {{-- <x-breadcrumbs title="Crear Album" />

    <x-sectioncontent>

        <div class="card mt-3">

            <div class="card-body">

            </div>
        </div>

    </x-sectioncontent> --}}
</div>
