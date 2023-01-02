@props(['orderid', 'field', 'wirekey', 'filename', 'iddrop', 'bg'=>'light'])

<div class="card border-warning">
    <div class="card-header bg-{{ $bg }}">{{ $slot }}</div>
    <div class="card-body">

        {{-- Funcion para cargar la foto --}}
        <div wire:ignore class="" wire:key="{{ $wirekey }}">

            <form method="POST" action="{{ route('user.sales.upload', [ 'order'=> $orderid, 'field'=> $field ]) }}" class="dropzone"
                id="{{ $iddrop }}">

            </form>
        </div>
        @if ($filename)
            <div class="text-center mt-3" style="100%">
                <img style="height: 150px;" src="{{ Storage::url($filename) }}" alt="">
            </div>
        @endif
    </div>
    {{-- Funcion para borrar la foto subida --}}
    @if ($filename)
        <div class="card-footer">
            <a href="#" wire:click.prevent="$emit('deletePhotoOrderJs','{{ $orderid }}', '{{ $field }}')"
                class="btn btn-danger d-block">Borrar</a>
        </div>
    @endif

</div>