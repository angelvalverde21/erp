<x-form.select id="payment_method_id" label="Cliente indica que pagara con" wirevalue="order.payment_method_id" icon="fa-solid fa-money-bill-1-wave" wirechange="saveSelected()">

    @foreach (paymentMethods() as $paymentMethod)

    <option value="{{ $paymentMethod->id }}"> {{ $paymentMethod->name }}</option>

        @foreach ($paymentMethod->paymentMethodChildrens as $paymentMethodChildren)
            @include('livewire.manage.orders.edit-order._navbar-pay-method-child', [
                'parent_name' => $paymentMethod->name,
                'child' => $paymentMethodChildren,
                'separador' => '--',
            ])
        @endforeach

    @endforeach

</x-form.select>
`
