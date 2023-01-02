@props(['wirevalue', 'type', 'icon' => '', 'texticon' => '', 'error' => '', 'label' => ''])

@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif

<div class="mb-3">
    <div class="input-group mb-1">
        {{-- <label for="inputDni" class="form-label">DNI</label> --}}

        @if ($texticon != '' || $icon != '')
            <span class="input-group-text">
                @if ($texticon != '')
                    {{ $texticon }}
                @else
                    @if ($icon != '')
                        <i class="{{ $icon }}"></i>
                    @endif
                @endif
            </span>
        @endif



        <input type="{{ $type }}" class="form-control" wire:model="{{ $wirevalue }}" aria-describedby="nameHelp"
            placeholder="{{ $slot }}">
    </div>

    @if ($error != '')
        @error($wirevalue)
            <span class="error">{{ $error }}</span>
        @enderror
    @endif

</div>
