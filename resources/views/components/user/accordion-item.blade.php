@props(['id','accordionParentId','label'])

<div class="accordion-item">
    <h2 class="accordion-header" id="{{ $id }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse-{{ $id }}" aria-expanded="true"
            aria-controls="collapse-{{ $id }}">
            {{ $label }}
        </button>
    </h2>
    
    <div id="collapse-{{ $id }}" class="accordion-collapse collapse"
        aria-labelledby="{{ $id }}" data-bs-parent="#{{ $accordionParentId }}">
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>