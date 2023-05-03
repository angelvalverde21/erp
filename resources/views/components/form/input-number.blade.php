@props(['wirevalue', 'step' => '0.01', 'texticon' => '', 'icon' => '', 'error' => '', 'label' => ''])
@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif
<div class="mb-3">
    <div class="input-group mb-1 nxumber">
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

        <input onclick="this.select();" pattern="[0-9]+([\.,][0-9]+)?" type="number" step="{{ $step }}" class="form-control" wire:model="{{ $wirevalue }}"
            aria-describedby="nameHelp" placeholder="{{ $slot }}">
    </div>

    @if ($error != '')
        @error($wirevalue)
            <span class="has-danger">{{ $error }}</span>
        @enderror
    @endif

</div>
