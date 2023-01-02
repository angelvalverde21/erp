<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Crear Producto
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-9 col-12">
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Titulo</label>
                                <input type="text" class="form-control" id="inputName" wire:model="product.name"
                                    aria-describedby="nameHelp" placeholder="Titulo del producto">
                                @error('product.name')
                                    <span class="error">Este campo es requerido</span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <div class="mb-3">
                                <label for="inputPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="inputPrecio" wire:model="product.price"
                                    aria-describedby="nameHelp" placeholder="0.00">
                                @error('product.price')
                                    <span class="error">indique el precio</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row hidden">
                        <div class="col-lg-12 col">
                            <div class="mb-3">
                                {{-- <label for="inputSlug" class="form-label">Slug</label> --}}
                                <input type="text" class="form-control" id="inputSlug" wire:model="product.slug"
                                    aria-describedby="nameHelp" readonly>
                                @error('product.slug')
                                    <span class="error">El nombre del articulo ya existe</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- fin de ficha tecnica --}}

                    {{-- Inicio de la seleccion de tallas --}}
                    
                    <div class="row">

                        <div class="col-lg-12 col">

                            <select name="" id="" class="form-control" wire:model="product.optionsize">

                                <option value="" selected>Escoja el tipo de talla</option>

                                @foreach ($optionSizes as $talla)
                                    <option value="{{ $talla['array_name'] }}">{{ $talla['array_name'] }} -
                                        ({{ $talla['description'] }})
                                    </option>
                                @endforeach

                            </select>

                            @error('product.optionsize')
                                <span class="error">seleccione el tipo de talla</span>
                            @enderror
                        </div>
                    </div>

                    
                    {{-- FIN de la seleccion de tallas --}}

                    {{-- inicio de Categorias y subcategorias --}}

                    <div class="row mb-3">
                        <div class="col-lg-6 col">

                            <label for="inputStateCategory" class="form-label">Categoria</label>

                            {{-- Categorias --}}

                            <select id="inputStateCategory" class="form-select" wire:model="category_id">

                                <option value="" selected disabled>Escoja una Categoria</option>

                                @foreach ($categories as $category)
                                    <option disabled value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- fin Categorias --}}

                            @error('category_id')
                                <span class="error">Escoja una Categoria</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 col">

                            <label for="inputStateSubCategory" class="form-label">Subcategoria</label>

                            {{-- SubCategorias --}}

                            <select id="inputStateSubCategory" class="form-select" wire:model="product.subcategory_id">

                                <option value="" selected>Escoja una sub categoria</option>

                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- Fin SubCategorias --}}

                            @error('product.subcategory_id')
                                <span class="error">seleccione la subcategoria</span>
                            @enderror

                        </div>
                    </div>

                    {{-- Categorias Recursivas --}}

                    <div class="row">

                        <div class="col-lg-12 col">

                            <select class="form-select mb-3">
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

                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <a href="#" class="mb-3">ó Agregue una categoria</a>
                        </div>
                    </div>

                    {{-- Categorias Recursivas Agregar Categoria --}}

                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="inputName" aria-describedby="nameHelp"
                                    placeholder="Agregar categoria">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col">
                            <label for="inputStateSubCategory" class="form-label">Categoria superior</label>
                            <select class="form-select mb-3">
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
                        </div>
                    </div>

                    {{-- Categorias Recursivas Agregar Categoria --}}


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" wire:loading.attr="disabled" wire.target="save"
                        wire:click="save"><i class="fa-solid fa-floppy-disk mr-1"></i> Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{-- El wire.loading.attr y el wire.target funcionan juntos --}}

                </div>

                {{-- <div class="modal-footer-2">
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire.target="test"
                        wire:click="test">Test</button>
                </div> --}}

            </div>
        </div>
    </div>


</div>
