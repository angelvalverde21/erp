<div>
    {{-- The Master doesn't talk, he acts. --}}
    {{-- ================================================================================== --}}
    {{-- ==== INICIO DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ==== --}}
    {{-- ================================================================================== --}}


    {{-- <input type="hidden" wire:model="location.user_id"> --}}

    <a href="#" class="btn btn-success my-3" data-toggle="modal" data-target="#agregarLocacion">Agregar locacion</a>

    <x-modal title="Crear Location" id="agregarLocacion" size="modal-lg">

        <div class="row">

            <div class="col-lg-12 col-12">
                <x-form.input type="text" wirevalue="location.name" icon="fa-solid fa-user" error="Este campo es requerido">
                    Nombre de la locacion
                </x-form.input>
            </div>
    
        </div>
    
        <div class="row">
    
            <div class="col-lg-6 col-12">
                <x-form.input type="text" wirevalue="location.primary" icon="fa-solid fa-dolly"
                    error="Este campo es requerido">
                    Direccion principal
                </x-form.input>
            </div>
    
            <div class="col-lg-6 col-12">
                <x-form.input type="text" wirevalue="location.secondary" error="Este campo es requerido">
                    Direccion secundaria
                </x-form.input>
            </div>
        </div>
    
        <div class="row">
    
            <div class="col-lg-12 col-12">
                <x-form.input type="text" wirevalue="location.references" icon="fa-solid fa-right-long">
                    Referencia
                </x-form.input>
            </div>
    
        </div>
    
        {{-- ================================================================================== --}}
        {{-- ==== INICIO DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ==== --}}
        {{-- ================================================================================== --}}
    
        <div class="row">
    
            <div class="col-lg-12 col-12">
    
                {{-- Input para seleccionar el distrito, pero ojo el verdadero id lo envian los campos de abajo --}}
                <input onclick="this.select();" type="text" class="form-control mb-3" wire:model.debounce.250ms="namedistrict"
                    aria-describedby="nameHelp" placeholder="Distrito">
    
                {{-- Elemento para fijar el valor del district_ id y activar el error por si el cliente no selecciona distrito --}}
    
                <input type="hidden" class="form-control" wire:model="location.district_id">
    
                @error('location.district_id')
                    <span class="error">Debe escoger un distrito</span>
                @enderror
    
                {{-- FIN Elemento para fijar el valor del district_ id y activar el error por si el cliente no selecciona distrito --}}
    
                <div class="">
    
                    <div class="list-group">
    
                        @if (is_array($districts) || is_object($districts))
    
                            @foreach ($districts as $district)
                                <button type="button" wire:click="districtAdd('{{ $district->id }}')"
                                    class="list-group-item list-group-item-action">{{ $district->name }}
                                    - {{ $district->province->name }} - Dpto.
                                    {{ $district->province->department->name }}</button>
                            @endforeach
    
                        @endif
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
    
        {{-- ================================================================================== --}}
        {{-- ===== FIN DEL INPUT DISTRITO QUE SOLO SERVIRARA PARA SELECCIONAR EL DISTRITO ===== --}}
        {{-- ================================================================================== --}}
    
    
        <div class="row">
            <div class="col-lg-12 col-12">
    
                <x-form.textarea label="" type="text" wirevalue="location.maps" icon="fa-solid fa-map-location">
                    Ingrese un url de google maps (Opcional)
                </x-form.textarea>
    
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12 col-12">
    
                <x-form.textarea label="" type="text" wirevalue="location.coordenadas" icon="fa-solid fa-map-location">
                    Si las tuviera, ingrese las cordenadas aqui (Opcional)
                </x-form.textarea>
    
            </div>
        </div>
        {{-- =================================== --}}
        {{-- ===== CONTROLES DEL FORMULARIO ===== --}}
        {{-- =================================== --}}
    
    
        <div class="btn-controls">
    
    
            <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
                wire:click="save" class="btn btn-primary ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
                Cambios</button>
    
            <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                <span class="sr-only">Loading...</span>
            </div>
    
        </div>
    
        {{-- ======================================= --}}
        {{-- ===== FIN CONTROLES DEL FORMULARIO ===== --}}
        {{-- ======================================= --}}
    </x-modal>



</div>
