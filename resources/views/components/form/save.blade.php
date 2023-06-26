@props(['label' => ''])

<button type="button" wire:loading.class="btn-secondary"
    wire:loading.attr="disabled" wire.target="save"
    wire:click="save" class="btn btn-success ml-auto">
    <i class="fa-solid fa-floppy-disk mr-1"></i> 
    <span>
        Guardar Cambios
    </span>
</button>
                
<div class="spinner-border" wire:loading.flex wire:target="save" role="status">
    <span class="sr-only">Loading...</span>
</div>