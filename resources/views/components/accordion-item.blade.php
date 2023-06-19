@props(['id', 'accordionParentId', 'label', 'show' => false, 'icon' => ''])

{{-- 

    Para usar acordion tenemos que envolver cada etiqueta con

        <div class="accordion" id="accordionExample">
            <x-accordion-item id="accordionId" accordionParentId="accordionExample"></x-accordion-item>
        </div>

    Donde id="accordionExample" es el accordionParentId que usaran los hijos 

--}}


<div class="accordion-item">

    <h2 class="accordion-header" id="{{ $id }}">

        @if ($icon != '')
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ $id }}" aria-expanded="true"
                aria-controls="collapse-{{ $id }}">
                <i class="{{ $icon }} me-2"></i> <strong>{{ $label }}</strong>
            </button>
        @else
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-{{ $id }}" aria-expanded="true"
                aria-controls="collapse-{{ $id }}">
                <strong>{{ $label }}</strong>
            </button>
        @endif




    </h2>

    @if ($show)
        <div id="collapse-{{ $id }}" class="accordion-collapse collapse show"
            aria-labelledby="{{ $id }}" data-bs-parent="#{{ $accordionParentId }}">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    @else
        <div id="collapse-{{ $id }}" class="accordion-collapse collapse"
            aria-labelledby="{{ $id }}" data-bs-parent="#{{ $accordionParentId }}">
            <div class="accordion-body">
                {{ $slot }}
            </div>
        </div>
    @endif

</div>
