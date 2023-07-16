<div>

    {{-- <x-breadcrumbs title="Crear warehouse" /> --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWareHouse">
        Crear nuevo warehouse
    </button>

    <x-modal id="createWareHouse" size="modal-lg" title="Crear warehouse">

        <form action="#">

            <div class="form-body">

                <div class="row p-t-20">

                    <div class="col-md-12">
                        <x-form.input type="text" wirevalue="warehouse.name" debounce="500"
                            error="Este campo es requerido">
                            Nombre de warehouse
                        </x-form.input>
                    </div>

                </div>

                {{-- <div class="row mb-3">
                        <div class="col">
                            @include('livewire.components.locations.show-locations')
                        </div>
                    </div> --}}

                {{-- @livewire('components.locations.create-location', ['reloadUrl' => true], 'location-warehouse') --}}

            </div>

        </form>

        <div class="botones">
            <div class="form-actions">
                <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="save"
                    class="btn btn-success"> <i class="fa fa-check"></i> Crear
                    warehouse</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>

        {{-- @livewire('components.locations.create-location', ['warehouse' => $warehouse, 'reloadUrl' => true], 'location-warehouse-' . $warehouse->id) --}}


    </x-modal>
</div>