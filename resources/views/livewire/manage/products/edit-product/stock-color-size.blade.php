<div>


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Talla</th>
                <th>Stock</th>
                <th>Nuevo Stock</th>
            </tr>

        </thead>

        <tbody>
            @foreach ($color->sizes as $size)

                <tr>
                    <td>{{ $size->pivot->id }}</td>
                    <td>{{ $size->name }}</td>
                    <td>{{ $size->pivot->quantity }}</td>
                    <td><input type="number" placeholder="0" class="form-control" wire:model="inputs.{{ $size->pivot->id }}.quantity">
                    </td>
                </tr>
            @endforeach

        </tbody>

        <tfoot>
            <tr>
                <td></td>
                <td>Total</td>
                <td>{{ $color->stock }}</td>
                <td>

                    <button type="button" wire:loading.attr="disabled" wire:click="guardarStock"
                    class="btn btn-primary w-100">Guardar</button>
                </td>
            </tr>
        </tfoot>

    </table>


    {{-- {{ $color->stock }} --}}

    {{-- Nothing in the world is as soft and yielding as water. --}}

</div>
