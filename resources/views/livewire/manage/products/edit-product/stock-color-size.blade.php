<div>

    {{-- <div class="mt-3">

    </div> --}}

    @foreach ($color->sizes as $size)

        <div class="content-info d-flex flex-row">

            <ul style="padding: 0" class="d-flex w-100 justify-content-between align-items-center me-3">
                {{-- <li>{{ $size->pivot->id }}</li> --}}
                <li class="text-center">
                    <h4>{{ $size->name }}: </h4>
                </li>
                <li class="text-center">
                    <h4>{{ $size->pivot->quantity }}</h4>
                </li>
                <li>+</li>
                <li class="text-center"><input type="number" style="width: 75px; margin: 0 auto" placeholder="0"
                        class="form-control" min="1"
                        wire:model.debounce.500ms="inputsAdd.{{ $size->pivot->id }}.quantity">
                </li>
                <li>=</li>
                <li class="text-center"><input type="number" style="width: 75px; margin: 0 auto" placeholder="0"
                        class="form-control" min="1"
                        wire:model.debounce.500ms="inputsTotal.{{ $size->pivot->id }}.quantity">
                    {{-- <td><input type="number" placeholder="0" class="form-control" wire:model="inputs.{{ $size->pivot->id }}.quantity"> --}}
                </li>
            </ul>
            <p class="">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample-{{ $size->pivot->id }}" aria-expanded="false"
                    aria-controls="collapseExample">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </p>
        </div>

        <div class="collapse" id="collapseExample-{{ $size->pivot->id }}">

            <div class="card card-body mb-3">

                @if (getStockColorSize($size->pivot->id)->count() > 0)
                    <table class="table">
                        <tr>
                            <td>id</td>
                            <td>observaciones</td>
                            <td></td>
                            <td>creacion</td>
                            <td>eliminar</td>
                        </tr>
                        @foreach (getStockColorSize($size->pivot->id)->get() as $stock)
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $stock->created_at }}</td>
                                <td><button class="btn btn-danger" wire:loading.attr="disabled" wire:click="eliminarStock({{ $stock->id }})"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    No hay elementos
                @endif
            </div>

        </div>
    @endforeach


    <button type="button" wire:loading.attr="disabled" wire:click="guardarStock"
        class="btn btn-primary w-100">Guardar</button>

    {{-- {{ $color->stock }} --}}

    {{-- Nothing in the world is as soft and yielding as water. --}}

</div>
