@props(['icon'=>'','alert'])
<div class="alert alert-{{ $alert }}" role="alert">
    <div>
        @if ($icon != "")
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $slot }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

</div>