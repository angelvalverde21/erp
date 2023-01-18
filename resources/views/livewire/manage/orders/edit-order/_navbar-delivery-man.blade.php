<x-form.select label="Entregado por" wirevalue="order.delivery_man_id" icon="fa-solid fa-person-biking"  wirechange="saveSelected()">
    @foreach (repartidores() as $repartidor)
        <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
        </option>
    @endforeach
</x-form.select>
