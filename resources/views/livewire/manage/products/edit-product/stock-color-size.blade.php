<div>


    <table class="table">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th colspan="6" style="background-color: #ccc">STOCK</th>
                {{-- <th>Agregar Stock</th> --}}
            </tr>
            <tr>
                {{-- <th>ID</th> --}}
                <th>TALLA</th>
                <th>ACTUAL</th>
                <th></th>
                <th>AGREGAR</th>
                <th></th>
                <th>NUEVO STOCK</th>
                {{-- <th>Agregar Stock</th> --}}
            </tr>

        </thead>

        <tbody>
            @foreach ($color->sizes as $size)

                <tr>
                    {{-- <td>{{ $size->pivot->id }}</td> --}}
                    <td>{{ $size->name }}</td>
                    <td>{{ $size->pivot->quantity }}</td>
                    <td>+</td>
                    <td class="text-center"><input type="number" style="width: 100px; margin: 0 auto" placeholder="0" class="form-control" min="1" wire:model.debounce.500ms="inputsAdd.{{ $size->pivot->id }}.quantity">
                    <td>=</td>
                    <td class="text-center"><input type="number" style="width: 100px; margin: 0 auto" placeholder="0" class="form-control" min="1" wire:model.debounce.500ms="inputsTotal.{{ $size->pivot->id }}.quantity">
                    {{-- <td><input type="number" placeholder="0" class="form-control" wire:model="inputs.{{ $size->pivot->id }}.quantity"> --}}
                    </td>
                </tr>
            @endforeach

        </tbody>

        <tfoot>
            <tr>
                {{-- <td></td> --}}
                <td>Total</td>
                <td>{{ $color->stock }}</td>
                <td>

                    <button type="button" wire:loading.attr="disabled" wire:click="guardarStock"
                    class="btn btn-primary w-100">Guardar</button>
                </td>
                {{-- <td>

                    <button type="button" wire:loading.attr="disabled" wire:click="guardarStock"
                    class="btn btn-primary w-100">Guardar</button>
                </td> --}}
            </tr>
        </tfoot>

    </table>


    {{-- {{ $color->stock }} --}}

    {{-- Nothing in the world is as soft and yielding as water. --}}

</div>
