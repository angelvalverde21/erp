@props(['wirevalue', 'id'=>'', 'error' => '', 'label' => '', 'rows'=>'2', 'icon'=>''])
<div class="mb-3">

    @if ($label != '')
        <label for="{{ $id }}" class="form-label"><i class="{{ $icon }} mr-1"></i> {{ $label }}</label>
    @endif

    <textarea wire:model.debounce.500ms="{{ $wirevalue }}" class="form-control" id="{{ $id }}" rows="{{ $rows }}" placeholder="{{ $slot }}"></textarea>

    @if ($error != '')
        @error($wirevalue)
            <span class="has-danger">{{ $error }}</span>
        @enderror
    @endif
</div>
