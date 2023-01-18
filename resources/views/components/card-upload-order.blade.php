@props(['orderid','store', 'field'=>"", 'wirekey', 'filename', 'iddrop', 'bg'=>'light', 'post'=>'manage.orders.upload'])

<div class="card border-warning">
    <div class="card-header bg-{{ $bg }}">{{ $slot }}</div>
    <div class="card-body">

        {{-- Funcion para cargar la foto --}}
        <div wire:ignore class="" wire:key="{{ $wirekey }}">

            @if ($field)
            <form method="POST" action="{{ route( $post , [ 'nickname'=> $store, 'order'=> $orderid, 'field'=> $field ]) }}" class=" d-flex justify-content-center p-2 dropzone"
                id="{{ $iddrop }}">
            @else
            <form method="POST" action="{{ route( $post , [ 'nickname'=> $store, 'order'=> $orderid ]) }}" class=" d-flex justify-content-center p-2 dropzone"
                id="{{ $iddrop }}">
            @endif

            </form>
        </div>
        @if ($filename)
            <div class="text-center mt-3" style="100%">
                <img style="height: 150px;" src="{{ asset('storage/' . $filename) }}" alt="">
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