<x-form.select wirevalue="order.delivery_method_id" icon="fa-solid fa-truck" wirechange="saveSelected()">

    @foreach (deliveryMethods() as $delivery_method)
        <option value="{{ $delivery_method->id }}">
            {{ $delivery_method->title }}</option>
    @endforeach
</x-form.select>
