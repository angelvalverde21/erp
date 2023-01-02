@props(['wirevalue', 'step' => '0.01', 'texticon' => '', 'icon' => '', 'error' => '', 'label' => ''])
@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif
<div class="mb-3">
    <div class="input-group mb-1 nxumber">
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



        <input type="number" step="{{ $step }}" class="form-control" wire:model="{{ $wirevalue }}"
            aria-describedby="nameHelp" placeholder="{{ $slot }}">
    </div>

    @if ($error != '')
        @error($wirevalue)
            <span class="error">{{ $error }}</span>
        @enderror
    @endif

</div>
