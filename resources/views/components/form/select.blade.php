@props(['wirevalue', 'id' => '', 'icon' => '', 'texticon' => '', 'error' => '', 'label' => '', 'wirechange'=>''])

@if ($label != '')
    <label for="" class="form-label">{{ $label }}</label>
@endif

<div class="input-group mb-3">

    <div class="input-group-prepend">
        <label class="input-group-text">
            @if ($texticon != '')
                {{ $texticon }}
            @else
                @if ($icon != '')
                    <i class="{{ $icon }}"></i>
                @endif
            @endif
        </label>
    </div>
    <select class="custom-select" id="{{ $id }}" wire:model="{{ $wirevalue }}" wire:change="{{ $wirechange }}">
        {{ $slot }}
    </select>

    <div class="d-flex w-100">
        @if ($error != '')
        @error($wirevalue)
            <span class="error has-danger">{{ $error }}</span>
        @enderror
        @endif
    </div>
</div>

