<option value="{{ $child_category->id }}">{{ $separador }} {{ $child_category->name }}</option>
@if ($child_category->categories)

        @foreach ($child_category->categories as $childCategory)
            {{-- @include('livewire.user.product.child_category', ['child_category' => $childCategory, 'separador'=>  $separador.' '.$child_category->name.' '.$separador]) --}}
            @include('livewire.user.product.categories.child_category', ['child_category' => $childCategory, 'separador'=>  $separador.$separador])
        @endforeach

@endif
