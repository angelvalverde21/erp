<div>
    {{-- Be like water. --}}
    <div class="mb-3">
        <div class="input-group mb-3">
            <input type="hidden" wire:model="address.user_id">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="mb-3">
                <div class="input-group mb-1">
                    {{-- <label for="inputDni" class="form-label">DNI</label> --}}
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-phone"></i></span>
                    <input type="number" class="form-control" id="inputPhone" wire:model="address.phone"
                        aria-describedby="nameHelp" placeholder="phone">
                </div>
                @error('address.phone')
                    <span class="error">Este campo es requerido</span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-6">
            <div class="mb-3">
                <div class="input-group mb-3">
                    {{-- <label for="inputDni" class="form-label">DNI</label> --}}
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-badge"></i></span>
                    <input type="number" class="form-control" id="inputDni" wire:model="address.dni"
                        aria-describedby="nameHelp" placeholder="DNI">
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 col-12">
            <div class="mb-3">
                <div class="input-group mb-1">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    {{-- <label for="inputName" class="form-label">Nombre completo</label> --}}
                    <input type="text" class="form-control" id="inputName" wire:model="address.name"
                        aria-describedby="nameHelp" placeholder="Nombre completo">
                </div>
                @error('address.name')
                    <span class="error">Este campo es requerido</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 col-12">
            <div class="mb-3">
                <div class="input-group mb-1">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-dolly"></i></span>
                    {{-- <label for="inputName" class="form-label">Nombre completo</label> --}}
                    <input type="text" class="form-control" id="inputAddressPrimary" wire:model="address.primary"
                        aria-describedby="nameHelp" placeholder="Direccion principal">
                </div>
                @error('address.primary')
                    <span class="error">Este campo es requerido</span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="mb-3">
                <input type="text" class="form-control" id="inputAddressSecondary" wire:model="address.secondary"
                    aria-describedby="nameHelp" placeholder="Direccion secundaria">

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12 col-12">
            <div class="mb-3">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-right-long"></i></span>
                    {{-- <label for="inputName" class="form-label">Nombre completo</label> --}}
                    <input type="text" class="form-control" id="inputReferences" wire:model="address.references"
                        aria-describedby="nameHelp" placeholder="Referencia">
                </div>

            </div>
        </div>

    </div>

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
                <input type="text" class="form-control" id="inputDistrict" wire:model="namedistrict"
                    aria-describedby="nameHelp" placeholder="Distrito">

                <input type="hidden" class="form-control" id="inputDistrict" wire:model="address.district_id">
                @error('address.district_id')
                    <span class="error">Debe escoger un distrito</span>
                @enderror

                <div class="resultados">
                    <ul>

                        @foreach ($districts as $district)
                            <li><a href="#"
                                    wire:click.prevent="$emit('districtAdded','{{ $district->id }}')">{{ $district->name }}
                                    - {{ $district->province->name }} - Dpto.
                                    {{ $district->province->department->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Botones Guardar Cambios --}}

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click="save" class="btn btn-info ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>Guardar
        Cambios</button>

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="test"
        wire:click="test" class="btn btn-info ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>tes
        test</button>

    <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>
