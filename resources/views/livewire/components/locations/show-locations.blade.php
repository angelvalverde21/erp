<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex">

                <select class="form-control custom-select mb-3 mr-2">
                    <option value="2">Escoger Locacion</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>

                <a href="#" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#newlocation">Nuevo</a>
            </div>
        </div>
        <!--/span-->

        <!--/span-->
    </div>
    {{-- <div class="select d-flex justify-content-between w-100">
        <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#location">
            Launch demo modal
        </button>
    </div> --}}

    <x-modal title="Agregar nueva locacion" id="newlocation" size="modal-lg">
        @livewire('components.locations.create-location')
    </x-modal>

</div>
