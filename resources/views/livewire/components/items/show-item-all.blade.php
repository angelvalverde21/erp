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
                            <td class="text-center">Imagen</td>
                            <td>Descripcion</td>
                            <td>Talla solicitada</td>
                            <td>Precio</td>
                            <td>Final</td>
                            <td>Stock</td>
                            <td>Mensaje</td>
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
                                            data-target="#editItem"></i></a> {{ $item->id }}
                                    <!-- fin de Button trigger modal para editar los item de la orden -->

                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                {{-- <td class="text-center">
                                    {{ extraerImagenOld($item->content->image) }}
                                    {{ $item->quantity_oversale }}</td> --}}

                                @if (isset($item->content->image))

                                
                                {{-- card-show-invoice.blade --}}
                                    <td class="text-center">
                                        <a href="{{ Storage::url($item->content->image) }}" data-lightbox="show-images-preview" data-title="Click the right half of the image to move forward.">
                                            <img src="{{ Storage::url($item->content->image) }}"
                                            height="75px" alt="">
                                        </a>
                                        </td>
                                @else
                                    <td class="text-center">Sin imagen</td>
                                @endif


                                <td>

                                    @if (isset($item->content->product_id))
                                    <a
                                        href="{{ route('manage.products.edit', [$store->nickname, $item->content->product_id]) }}">{{ $item->description }}</a>

                                @else
                                    <td class="text-center">Sin url</td>
                                @endif


                                    <div class="content-stock">

                                        <div class="display-stock">

                                            @if ($item->stocks->count())
                                                @foreach ($item->stocks as $stock)
                                                    <table>
                                                        <tr>
                                                            <td>Stock asignado</td>
                                                            <td>00000000{{ $stock->id }}</td>
                                                            <td>STATUS : {{ $stock->status }}</td>
                                                            <td>{{ $stock->stockable->size->name }}</td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            @else
                                                @livewire('components.items.add-stock-item', ['item' => $item], key('add-stock-item-' . $item))
                                            @endif

                                        </div>

                                    </div>

                                </td>
                                <td class="text-center">{{ $item->content->talla_impresa }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->precio_final }}</td>

                                {{-- {{ $item->content->file_name }} --}}
                                <td>
                                    
                                    @if ($item->quantity > 0)
                                        <a href="#" class="btn btn-success"><i
                                                class="fa-solid fa-circle-check"></i></a>
                                    @elseif($item->quantity_oversale > 0)
                                        <a href="#" class="btn btn-danger"><i
                                                class="fa-solid fa-triangle-exclamation"></i></a>
                                        <span class="badge bg-secondary">Sin stock</span>
                                    @endif

                                </td>

                                <td>
                                    @if ($item->quantity_oversale > 0 && stockColorSizeId($item->content->color_size_id) >= $item->quantity_oversale)
                                        <a href="#" class="btn btn-light"
                                            wire:click="corregirStock({{ $item->id }})">Corregir</a>
                                    @else
                                        Quedan {{ stockColorSizeId($item->content->color_size_id) }}
                                    @endif
                                </td>

                                <td class="text-center">

                                    @if ($order->is_active)
                                        <div class="" wire:key="item-{{ $item->id }}">
                                            <a href="#" wire:click.prevent="deleteItem({{ $item->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="deleteItem({{ $item->id }})"
                                                style="font-size: 20pt;"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            @if ($order->is_active)
                @livewire('components.items.add-item', ['order' => $order], key('add-item-' . $order->id))
            @else
            @endif
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


                <x-user.select  wirevalue="item.content.talla_impresa" error="Este campo es requerido">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="ESTANDAR">ESTANDAR</option>
                </x-user.select>

                {{-- <x-user.input type="text" wirevalue="item.content.talla_impresa" error="Este campo es requerido">
                    Talla Virtual
                </x-user.input> --}}
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
