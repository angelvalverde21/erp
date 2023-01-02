@props(['id','accordionParentId','label'])

<div class="card">
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
</div>