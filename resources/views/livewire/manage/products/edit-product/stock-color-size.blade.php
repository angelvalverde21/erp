<div>

    <table class="table">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th colspan="7" style="background-color: #ccc">STOCK</th>
                {{-- <th>Agregar Stock</th> --}}
            </tr>
            <tr>
                {{-- <th>ID</th> --}}
                <th>ID</th>
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

            {{-- Comienza una nueva liea del bucle donde estan los datos --}}



            @foreach ($color->sizes as $size)
                <tr>
                    {{-- <td>{{ $size->pivot->id }}</td> --}}
                    <td>{{ $size->pivot->id }}</td>
                    <td>{{ $size->name }}</td>
                    <td>{{ $size->pivot->quantity }}</td>
                    <td>+</td>
                    <td class="text-center"><input type="number" style="width: 100px; margin: 0 auto" placeholder="0"
                            class="form-control" min="1"
                            wire:model.debounce.500ms="inputsAdd.{{ $size->pivot->id }}.quantity"></td>
                    <td>=</td>
                    <td class="text-center"><input type="number" style="width: 100px; margin: 0 auto" placeholder="0"
                            class="form-control" min="1"
                            wire:model.debounce.500ms="inputsTotal.{{ $size->pivot->id }}.quantity">
                        {{-- <td><input type="number" placeholder="0" class="form-control" wire:model="inputs.{{ $size->pivot->id }}.quantity"> --}}
                    </td>
                </tr>

                <tr>
                    <td colspan="7">

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


    @foreach ($color->sizes as $size)
        <div class="accordion" id="accordionExample-{{ $size->pivot->id }}">

            <div class="accordion-item">
                <div class="content-collapse row">
                    <div class="col-lg-8 data-collapse">
                        <li>{{ $size->pivot->id }}</li>
                        <li>{{ $size->name }}</li>
                        <li>{{ $size->pivot->quantity }}</li>
                        <li>+</li>
                        <li class="text-center"><input type="number" style="width: 100px; margin: 0 auto"
                                placeholder="0" class="form-control" min="1"
                                wire:model.debounce.500ms="inputsAdd.{{ $size->pivot->id }}.quantity">
                        </li>
                        <li>=</li>
                        <li class="text-center"><input type="number" style="width: 100px; margin: 0 auto"
                                placeholder="0" class="form-control" min="1"
                                wire:model.debounce.500ms="inputsTotal.{{ $size->pivot->id }}.quantity">
                            {{-- <td><input type="number" placeholder="0" class="form-control" wire:model="inputs.{{ $size->pivot->id }}.quantity"> --}}
                        </li>

                    </div>
                    <button class="col-lg-4 accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo-{{ $size->pivot->id }}" aria-expanded="false"
                        aria-controls="collapseTwo">

                    </button>
                </div>

                <div id="collapseTwo-{{ $size->pivot->id }}" class="accordion-collapse collapse"
                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample-{{ $size->pivot->id }}">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- {{ $color->stock }} --}}

    {{-- Nothing in the world is as soft and yielding as water. --}}

</div>
