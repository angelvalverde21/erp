@props(['id','accordionParentId','label'])

{{-- <div class="card">
    <div class="card-header" id="{{ $id }}">
        <h2 class="accordion-header">
            <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ $id }}" aria-expanded="true"
                aria-controls="collapse-{{ $id }}">
                <h4 class="my-0">{{ $label }}</h4>
            </button>
        </h2>
    </div>

    
    <div id="collapse-{{ $id }}" class="accordion-collapse collapse"
        aria-labelledby="{{ $id }}" data-bs-parent="#{{ $accordionParentId }}">
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div> --}}


<div class="accordion-item">

    <h2 class="accordion-header" id="{{ $id }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id }}"
            aria-expanded="true" aria-controls="collapse-{{ $id }}">
            {{ $label }}
        </button>
    </h2>

    <div id="collapse-{{ $id }}" class="accordion-collapse collapse" aria-labelledby="{{ $id }}"
        data-bs-parent="#{{ $accordionParentId }}">
        <div class="accordion-body">
            {{ $slot }}
        </div>
    </div>
</div>