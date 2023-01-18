<option value="{{ $child->id }}">{{ $separador }} {{ $child->name }}</option>
    
@if ($child->paymentMethods)
        @foreach ($child->paymentMethods as $childPaymentMethod)
            {{-- @include('livewire.user.product.child', ['child' => $childCategory, 'separador'=>  $separador.' '.$child->name.' '.$separador]) --}}
            @include('livewire.manage.orders.edit-order._navbar-pay-method-child', ['child' => $childPaymentMethod, 'separador'=>  $separador.$separador])
        @endforeach

@endif