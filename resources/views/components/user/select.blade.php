@props(['wirevalue', 'icon' => '', 'texticon' => '', 'error' => '', 'label' => '', 'wirechange'=>''])

@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif

<div class="input-group mb-3">

    <label class="input-group-text">
        @if ($texticon != '')
            {{ $texticon }}
        @else
            @if ($icon != '')
                <i class="{{ $icon }}"></i>
            @endif
        @endif
    </label>

    <select class="form-select" wire:model="{{ $wirevalue }}" wire:change="{{ $wirechange }}">

        {{ $slot }}

    </select>

    @if ($error != '')
        @error($wirevalue)
            <span class="error">{{ $error }}</span>
        @enderror
    @endif

</div>
