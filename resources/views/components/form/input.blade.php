@props(['wirevalue', 'type'=> 'text', 'icon' => '', 'texticon' => '', 'error' => '', 'label' => ''])

@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif

<div class="mb-3">
    <div class="input-group mb-1">
        {{-- <label for="inputDni" class="form-label">DNI</label> --}}

        @if ($texticon != '' || $icon != '')
        <div class="input-group-prepend">
            <span class="input-group-text">
                @if ($texticon != '')
                    {{ $texticon }}
                @else
                    @if ($icon != '')
                        <i class="{{ $icon }}"></i>
                    @endif
                @endif
            </span>
        </div>
        @endif

        <input type="{{ $type }}" class="form-control" wire:model="{{ $wirevalue }}" aria-describedby="nameHelp"
            placeholder="{{ $slot }}">
    </div>

    @if ($error != '')
        @error($wirevalue)
        <div class=" has-danger">
            <span class="form-control-feedback">{{ $error }}</span>
        </div>
        @enderror
    @endif

</div>

