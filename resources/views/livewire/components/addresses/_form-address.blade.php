{{-- ================================================================================== --}}
{{-- ==== INICIO DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ==== --}}
{{-- ================================================================================== --}}


<input type="hidden" wire:model="address.user_id">

<div class="row">

    <div class="col-lg-6 col-6">
        <x-form.input type="number" wirevalue="address.phone" icon="fa-solid fa-phone" error="Este campo es requerido">
            Phone
        </x-form.input>
    </div>

    <div class="col-lg-6 col-6">
        <x-form.input type="number" wirevalue="address.dni" icon="fa-solid fa-id-badge">
            DNI o RUC
        </x-form.input>
    </div>
</div>

<div class="row">

    <div class="col-lg-12 col-12">
        <x-form.input type="text" wirevalue="address.name" icon="fa-solid fa-user" error="Este campo es requerido">
            Nombre completo o Razon Social
        </x-form.input>
    </div>

</div>

<div class="row">

    <div class="col-lg-6 col-12">
        <x-form.input type="text" wirevalue="address.primary" icon="fa-solid fa-dolly"
            error="Este campo es requerido">
            Direccion principal
        </x-form.input>
    </div>

    <div class="col-lg-6 col-12">
        <x-form.input type="text" wirevalue="address.secondary">
            Direccion secundaria
        </x-form.input>
    </div>
</div>

<div class="row">

    <div class="col-lg-12 col-12">
        <x-form.input type="text" wirevalue="address.references" icon="fa-solid fa-right-long">
            Referencia
        </x-form.input>
    </div>

</div>

{{-- ================================================================================== --}}
{{-- ==== INICIO DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ==== --}}
{{-- ================================================================================== --}}

<div class="row">

    <div class="col-lg-12 col-12">

        @if (isset($form_type) && $form_type == 'update')
            <div class="mb-3" wire:key="disctric-{{ $address->id }}">
            @else
                <div class="mb-3">
        @endif

        <input type="text" class="form-control" wire:model.debounce.250ms="namedistrict" aria-describedby="nameHelp"
            placeholder="Distrito">

        {{-- Elemento para fijar el valor del district_ id y activar el error por si el cliente no selecciona distrito --}}

        @if (isset($form_type) && $form_type == 'update')
            <input type="hidden" class="form-control" wire:model="address.district_id"
                wire:key="address-receibe-{{ $address->id }}">
        @else
            <input type="hidden" class="form-control" wire:model="address.district_id">
        @endif

        @error('address.district_id')
            <span class="error">Debe escoger un distrito</span>
        @enderror

        {{-- FIN Elemento para fijar el valor del district_ id y activar el error por si el cliente no selecciona distrito --}}

        <div class="">

            <div class="list-group">

                @if (is_array($districts) || is_object($districts))

                    @foreach ($districts as $district)
                        <button type="button" wire:click="districtAdd('{{ $district->id }}')" class="list-group-item list-group-item-action">{{ $district->name }}
                            - {{ $district->province->name }} - Dpto.
                            {{ $district->province->department->name }}</button>
                    @endforeach

                @endif
            </div>

        </div>

    </div>

</div>
</div>

{{-- ================================================================================== --}}
{{-- ===== FIN DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ===== --}}
{{-- ================================================================================== --}}


<div class="row">
    <div class="col-lg-12 col-12">
        <hr>
        <x-form.textarea label="Ingrese un url de google maps de su local" type="text" wirevalue="address.maps"
            icon="fa-solid fa-map-location">
            Ingrese un url de google maps
        </x-form.textarea>

        <x-form.input type="text" wirevalue="address.title" icon="fa-regular fa-user"
            error="Este campo es requerido">
            Agregue un titulo a la direccion Ejemplo: Oficina Principal
        </x-form.input>
    </div>

</div>
{{-- =================================== --}}
{{-- ===== CONTROLES DEL FORMULARIO ===== --}}
{{-- =================================== --}}


<div class="btn-controls">



    @if (isset($form_type) && $form_type == 'update' && !$selected)
        {{-- {{ $selected }} --}}
        <div class="col">
            <div class="float-right" wire:key="delete-address-{{ $address->id }}">
                <button wire:click="deleteAddress({{ $address->id }})" wire:loading.attr="disabled"
                    wire:target="deleteAddress({{ $address->id }})" class="btn btn-danger"><i
                        class="fa-solid fa-trash-can"></i> Eliminar</button>
            </div>
        </div>
    @endif

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click="save" class="btn btn-info ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
        Cambios</button>

    <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>

{{-- ======================================= --}}
{{-- ===== FIN CONTROLES DEL FORMULARIO ===== --}}
{{-- ======================================= --}}
