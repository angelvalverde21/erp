<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="fas fa-edit mr-2"></i>Info producto</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body">

                    {{-- ficha tecnica del producto --}}

                    <div class="row">

                        <div class="col-lg-9 col-12">
                            <x-user.input type="text" wirevalue="product.name" error="Este campo es requerido">
                                Titulo
                            </x-user.input>
                        </div>

                        <div class="col-lg-3 col-12">
                            <x-user.input type="number" wirevalue="product.price" error="Este campo es requerido">
                                Precio
                            </x-user.input>
                        </div>

                    </div>

                    <div class="row hidden">
                        <div class="col-lg-12 col">
                            <x-user.input type="text" wirevalue="product.slug" error="este producto ya existe">
                                Url del producto
                            </x-user.input>
                        </div>
                    </div>

                    {{-- Categorias Recursivas --}}

                    <div class="row">

                        <div class="col">

                            <div class="d-flex">

                                <select class="form-select mb-3 mr-2" wire:model="product.category_id"
                                    wire:change="selectCategory($event.target.value)">
                                    @foreach ($categoriesRecursive as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>

                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('livewire.user.product.child_category', [
                                                'child_category' => $childCategory,
                                                'separador' => '--',
                                            ])
                                        @endforeach
                                    @endforeach
                                </select>

                                @error('product.category_id')
                                    <span class="error">Debe seleccioar una categoria</span>
                                @enderror

                                <a href="#" class="btn btn-secondary mb-3" data-toggle="modal"
                                    data-target="#newcategory">Nuevo</a>
                            </div>
                        </div>

                    </div>

                    {{-- tallas --}}

                    @if (isset($this->category->has_size) && $this->category->has_size == 1)

                        <div class="row">

                            <div class="col-lg-12 col">

                                <label for="">Ingrese la talla real de su inventario</label>

                                <select name="" id="" class="form-control"
                                    wire:model="product.optionsize">

                                    <option value="" selected>Escoja el tipo de talla</option>

                                    @foreach ($optionSizes as $talla)
                                        <option value="{{ $talla['array_name'] }}">{{ $talla['array_name'] }}
                                            @if ($talla['description'])
                                                - ({{ $talla['description'] }})
                                            @endif
                                        </option>
                                    @endforeach

                                </select>

                                @error('product.optionsize')
                                    <span class="error">seleccione el tipo de talla</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                </div> {{-- fin del body --}}

                <div class="card-footer">
                    <div class="col mt-3 d-flex">
                        <x-jet-action-message class="mr-3" on="guardando">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </x-jet-action-message>
                        <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="save"
                            class="btn btn-primary ml-auto">Guardar cambios</button>
                    </div>
                </div>
            </div>

        </div>



    </section>


    <x-user.modal title="Agregar nueva categoria" id="newcategory" size="modal-lg">

        @livewire('user.product.categories.create-category', key('create-category'))

        <x-slot name="footer">

        </x-slot>

    </x-user.modal>

</div>
