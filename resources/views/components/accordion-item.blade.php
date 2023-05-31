@props(['id', 'accordionParentId', 'label', 'show' => false])

{{-- 

    Para usar acordion tenemos que envolver cada etiqueta con

        <div class="accordion" id="accordionExample">
            <x-accordion-item id="accordionId" accordionParentId="accordionExample"></x-accordion-item>
        </div>

    Donde id="accordionExample" es el accordionParentId que usaran los hijos 

--}}


<div class="accordion-item">

    <h2 class="accordion-header" id="{{ $id }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse-{{ $id }}" aria-expanded="true"
            aria-controls="collapse-{{ $id }}">
            {{ $label }}
        </button>
    </h2>

    @if ($show)
        <div id="collapse-{{ $id }}" class="accordion-collapse collapse show" aria-labelledby="{{ $id }}"
            data-bs-parent="#{{ $accordionParentId }}">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    @else
        <div id="collapse-{{ $id }}" class="accordion-collapse collapse" aria-labelledby="{{ $id }}"
            data-bs-parent="#{{ $accordionParentId }}">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    @endif
    
</div>
