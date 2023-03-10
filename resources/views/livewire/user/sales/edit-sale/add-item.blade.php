<div>
    {{-- Success is as dangerous as failure. --}}


    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-item-sale">
        <i class="fa-solid fa fa-square-plus mr-2"></i>Agregar item
    </button>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="add-item-sale" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <style>
                        .resultados ul {
                            margin: 0 !important;
                            padding: 0 10px !important;
                        }

                        .resultados {
                            box-shadow: -2px 3px 24px 0px rgba(163, 163, 163, 1);
                            border-radius: 0 0 10px 10px;
                        }

                        .resultados ul li {
                            border-bottom: 1px solid #ccc;
                            padding-bottom: 3px;
                        }
                    </style>

                    <div class="row">

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col">
                            <div class="mb-3">

                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fa-solid fa-magnifying-glass"></i></span></span>
                                    </div>
                                    <input type="text" class="form-control" id="inputSearchText" wire:model="search"
                                        aria-describedby="nameHelp" placeholder="Buscar producto">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><a href="#"
                                                wire:click.prevent="deleteSearchText"><i
                                                    class="fa-solid fa-trash"></i></a></span></span>
                                    </div>
                                </div>



                                <div class="resultados">
                                    <ul>

                                        @foreach ($items as $item)
                                            <li><a href="#"
                                                    wire:click.prevent="selectItem({{ $item->id }})">{{ $item->name }}</a>
                                            </li>
                                        @endforeach

                                        @if ($product && $showSelect)

                                            <table class="table">

                                                <thead>
                                                    <tr class="fw-bold">
                                                        <td class="text-center">#ID</td>
                                                        <td class="text-center">Imagen</td>
                                                        <td class="text-center">Color</td>
                                                        <td></td>
                                                        <td>Qty</td>
                                                        <td>PreVender</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    {{-- Recorremmos todos los colores del producto para poder hacer una lista con foreach --}}

                                                    {{-- inicio de cada color --}}
                                                    @foreach ($product->colors as $color)
                                                        {{-- inicio de cada talla --}}
                                                        @foreach ($color->sizes as $size)
                                                            <tr>

                                                                @if ($loop->first)
                                                                    <td class="text-center"
                                                                        rowspan="{{ $loop->count }}">
                                                                        {{ $color->id }}</td>

                                                                    {{-- Imagen --}}


                                                                    <td class="text-center"
                                                                        rowspan="{{ $loop->count }}">
                                                                        <img width="100"
                                                                            src="{{ Storage::url($color->file_name) }}"
                                                                            alt="">
                                                                    </td>

                                                                    {{-- fin de imagen --}}

                                                                    <td rowspan="{{ $loop->count }}">
                                                                        {{ $color->name }}</td>
                                                                @endif

                                                                {{-- Precio de venta final --}}

                                                                {{-- <td><input style="width: 100px" type="text" wire:model="product.price" class="form-control" placeholder="0.00"></td> --}}

                                                                {{-- Fin de precio de venta final --}}

                                                                {{-- Talla real --}}
                                                                <td class="py-3">

                                                                    {{ $size->name }} (color_size_id:
                                                                    {{ $size->pivot->id }})

             
                                                                </td>

                                                                {{-- fin de talla real --}}

                                                                {{-- Talla Virtual --}}

                                                                {{-- <td><input style="width: 75px; text-align: center" type="text" value="{{ $size->name }}" class="form-control" placeholder="Talla Virtual"></td> --}}

                                                                {{-- Fin de talla Virtual --}}

                                                                {{-- Cantidad --}}

                                                                <td class="text-center">


                                                                    <div class="input-group">
                                                                        {{-- {{$size->pivot->quantity}} --}}
                                                                        <select name="" id=""
                                                                            wire:change="consultarStock({{ $size->pivot->id }})"
                                                                            wire:model="quantity.{{ $size->pivot->id }}"
                                                                            class="form-select">

                                                                            <option value="0" selected>0</option>

                                                                            @for ($i = 1; $i <= $size->pivot->quantity; $i++)
                                                                                <option value="{{ $i }}">
                                                                                    {{ $i }}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>

                                                                </td>

                                                                {{-- color_id --}}
                                                                {{-- <input type="hidden"  wire:model="color_id.{{ $size->pivot->id }}"> --}}
                                                                {{-- size_ids --}}
                                                                {{-- <input type="hidden"  wire:model="size_id.{{ $size->pivot->id }}"> --}}
                                                                {{-- <input type="hidden"  wire:model="color_size_id.{{ $size->pivot->id }}" value=""> --}}

                                                                <td class="text-center">
                                                                    @if (!quantity($product->id, $color->id, $size->id))
                                                                        <input wire:model="quantity_oversale.{{ $size->pivot->id }}"
                                                                            style="width: 75px;" type="number"
                                                                            class="form-control" placeholder="0">
                                                                </td>
                                                        @endif

                                                        {{-- fin Cantidad --}}

                                                        {{-- Boton de agregar item --}}
                                                        <td class="text-center">
                                                            @if ((isset($quantity[$size->pivot->id]) && $quantity[$size->pivot->id] > 0) || (isset($quantity_oversale[$size->pivot->id]) && $quantity_oversale[$size->pivot->id] > 0))
                                                                <a href="#"
                                                                    wire:click.prevent="addItem({{ $size->pivot->id }})"
                                                                    class="btn btn-success">
                                                                    <i class="fa-solid fa-square-plus"></i></a>
                                                            @else
                                                                <a href="#"
                                                                    wire:click.prevent="addItem({{ $size->pivot->id }})"
                                                                    class="btn btn-secondary disabled">
                                                                    <i class="fa-solid fa-square-plus"></i></a>
                                                            @endif

                                                        </td>
                                                        {{-- Fin Boton de agregar item --}}
                                                        </tr>
                                                    @endforeach
                                                    {{-- fin de cada talla --}}
                                        @endforeach
                                        {{-- fin de cada color --}}

                                        </tbody>
                                        </table>



                                        @endif

                                    </ul>
                                </div>
                                {{-- Fin de resultados --}}

                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>

    </div>
</div>
