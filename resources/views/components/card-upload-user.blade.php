@props(['userid', 'field', 'wirekey', 'filename', 'iddrop'])

<div class="card mt-3">
    <div class="card-header">{{ $slot }}</div>
    <div class="card-body">

        {{-- Funcion para cargar la foto --}}
        <div wire:ignore class="" wire:key="{{ $wirekey }}">

            <form method="POST" action="{{ route('user.profile.upload', [ 'user'=> $userid, 'field'=> $field ]) }}" class="dropzone"
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
            <a href="#" wire:click.prevent="$emit('uploadPhotoJs','{{ $userid }}', '{{ $field }}')"
                class="btn btn-danger d-block">Borrar</a>
        </div>
    @endif

</div>