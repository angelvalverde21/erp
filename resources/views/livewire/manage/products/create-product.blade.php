<div>
    
    <x-breadcrumbs title="Crear Producto" />

    <x-sectioncontent>

        <div class="card">

            <div class="card-body">
                <form action="#">
                    <div class="form-body">

                        <hr>
                        
                        <div class="row p-t-20">

                            <div class="col-md-8">
                                <x-form.input type="text" wirevalue="product.name" debounce="500"
                                    error="Este campo es requerido">
                                    Titulo
                                </x-form.input>
                            </div>

                            <!--/span-->
                            <div class="col-md-2">
                                <x-form.input type="number" wirevalue="product.costo"
                                    error="Este campo es requerido">
                                    Precio Costo
                                </x-form.input>
                            </div>
                            <!--/span-->
                            <div class="col-md-2">
                                <x-form.input type="number" wirevalue="product.price"
                                    error="Este campo es requerido">
                                    Precio
                                </x-form.input>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <x-form.input disabled="disabled" type="text" wirevalue="product.slug"
                                    error="este producto ya existe">
                                    Url del producto
                                </x-form.input>
                            </div>

                        </div>
                        <!--/row-->
                        <h3 class="box-title">Seleccionar Categoria</h3>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex">

                                    <select class="form-control custom-select mb-3 mr-2"
                                        wire:model="product.category_id"
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
                            <!--/span-->

                            <!--/span-->
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                {{-- tallas --}}

                                @if (isset($this->category->has_size) && $this->category->has_size == 1)

                                    <label for="">Ingrese la talla real de su inventario</label>

                                    <select name="" id="" class="form-control"
                                        wire:model="product.optionsize">

                                        <option value="" selected>Escoja el tipo de talla</option>

                                        @foreach ($optionSizes as $talla)
                                            <option value="{{ $talla['array_name'] }}">
                                                {{ $talla['array_name'] }}
                                                @if ($talla['description'])
                                                    - ({{ $talla['description'] }})
                                                @endif
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('product.optionsize')
                                        <span class="error">seleccione el tipo de talla</span>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <!--/row-->

                    </div>

                    <div class="botones">
                        <div class="form-actions">
                            <button type="button" wire:loading.attr="disabled" wire.target="save"
                                wire:click="save" class="btn btn-success"> <i class="fa fa-check"></i> Crear
                                Producto</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>

                        <div wire:loading wire:target="save" class="spinner-borderx" role="status">
                            <span class="sr-onlyx">Espere...</span>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </x-sectioncontent>




    <x-modal title="Agregar nueva categoria" id="newcategory" size="modal-lg">

        @livewire('manage.products.categories.create-category', key('create-category'))

        <x-slot name="footer">
            <span wire:loading wire:target="saveCategory">Espere...</span>
            <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="saveCategory"
                class="btn btn-danger waves-effect waves-light ml-auto">Guardar</button>
        </x-slot>

    </x-modal>

</div>
