<x-form.select label="Entregado por" wirevalue="order.delivery_man_id" icon="fa-solid fa-person-biking"
    wirechange="saveSelected()">
    <option value="0">Seleccionar</option>

    {{ $order->store }}

    @foreach ($order->store->repartidores($order->store_id) as $repartidor)
        <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
        </option>
    @endforeach
</x-form.select>
