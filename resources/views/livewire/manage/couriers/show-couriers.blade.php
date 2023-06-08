<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{-- @foreach ($couriers as $courier)
        {{ $courier->name }}
    @endforeach --}}

    <x-breadcrumbs title="Empresas de Courier" />

    <x-sectioncontent>
        @livewire('components.carriers.show-carrier-all')
    </x-sectioncontent>
</div>
