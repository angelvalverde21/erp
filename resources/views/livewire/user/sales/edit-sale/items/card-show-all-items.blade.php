<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card bg-">
        <div class="card-body py-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-secondary">
                        <tr>
                            <td class="text-center">ID</td>
                            <td class="text-center">QTY</td>
                            <td class="text-center">IMAGEN</td>
                            <td>DESCRIPCION</td>
                            <td>TALLA</td>
                            <td>VIRTUAL</td>
                            <td>PRECIO</td>
                            <td>FINAL</td>
                            <td>Stock</td>
                            <td>Stock</td>
                            <td class="text-center">Eliminar</td>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">

                                    <!-- Button trigger modal para editar los item de la orden -->
                                    <a style="font-size: 15pt;" wire:ignore.self
                                        wire:click.prevent="editItem({{ $item }})" href="#"><i
                                            class="fa-solid fa-pen-to-square" data-toggle="modal"
                                            data-target="#editItem"></i></a>
                                    <!-- fin de Button trigger modal para editar los item de la orden -->

                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center"><img src="{{ Storage::url($item->content->file_name) }}"
                                        height="75px" alt=""></td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->talla_real }}</td>
                                <td>{{ $item->talla_impresa }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->precio_final }}</td>

                                {{-- {{ $item->content->file_name }} --}}
                                <td>
                                    @if ($item->quantity > 0)
                                        <a href="#" class="btn btn-success"><i class="fa-solid fa-circle-check"></i></a>
                                    @elseif($item->quantity_oversale > 0)
                                        <a href="#" class="btn btn-danger"><i class="fa-solid fa-triangle-exclamation"></i></a>
                                        <span class="badge bg-secondary">Sin stock</span>
                                    @endif



                                </td>

                                <td>
                                    @if ($item->quantity_oversale > 0 && ( stockColorSizeId($item->content->color_size_id) >= $item->quantity_oversale ))
                                        <a href="#" class="btn btn-light" wire:click="corregirStock({{ $item->id }})">Corregir</a>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <div class="" wire:key="item-{{ $item->id }}">
                                        <a href="#" wire:click.prevent="deleteItem({{ $item->id }})"
                                            wire:loading.attr="disabled" wire:target="deleteItem({{ $item->id }})"
                                            style="font-size: 20pt;"><i class="fa-solid fa-trash"></i></a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            @livewire('user.sales.edit-sale.add-item', ['order' => $order], key('add-item-' . $order->id))
        </div>
    </div>

    <!-- Modal para editar los items -->

    <x-user.modal title="Editar Item" id="editItem">

        <div class="row">
            <div class="col-lg-12 col-12">
                <x-user.input type="text" wirevalue="item.description" error="Este campo es requerido">
                    Descripcion
                </x-user.input>
            </div>

            <div class="col-lg-6 col-6">
                <x-user.input type="text" wirevalue="item.content.talla" error="Este campo es requerido">
                    Talla Virtual
                </x-user.input>
            </div>

            <div class="col-lg-6 col-6">
                <x-user.input type="text" wirevalue="item.content.price" texticon="S/."
                    error="Este campo es requerido">
                    Precio
                </x-user.input>
            </div>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-info" wire:loading.attr="disabled" wire.target="save"
                wire:click="saveEditItem"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
            </button>
        </x-slot>

    </x-user.modal>

</div>
