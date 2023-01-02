@props(['title','titlesmall'=>""])
<div class="card mt-3">

    <div class="card-header">
        <div>{{ $title }} </div><small>{{ $titlesmall }}</small>
    </div>

    <div class="card-body">

        {{ $slot }}

    </div>

    <div class="card-footer d-flex">
        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
            wire:click="save" class="btn btn-primary ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
            Cambios</button>

        <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div>
