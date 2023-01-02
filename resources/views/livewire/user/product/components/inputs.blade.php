<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="fas fa-edit mr-2"></i> Complete la informacion del producto</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- {{ $product }} --}}

    <section class="content">

        <div class="container-fluid">

            <style>
                ul {
                    margin: 0px;
                    padding: 0px;
                }
            </style>

            {{-- ficha tecnica --}}


            <div class="card">

                <div class="card-body">

                    {{-- ficha tecnica del producto --}}

                    <div class="row">
                        
                        <div class="col-lg-12 col-12">

                            <div class="mb-3">
                                <input type="text" class="form-control" id="inputName" wire:model="product.name"
                                    aria-describedby="nameHelp" placeholder="Titulo del producto">
                                @error('product.name')
                                    <span class="error">Este campo es requerido</span>
                                @enderror
                                <small class="badge bg-secondary mt-2">{{ $product->category->name }}</small>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col">
                            <x-user.input type="text" wirevalue="product.slug" error="Este slug ya esta en uso">
                                Slug
                            </x-user.input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-12">

                            <x-user.input type="number" wirevalue="product.price" error="Debe indicar el precio">
                                Precio Normal
                            </x-user.input>

                        </div>
                        <div class="col-lg-6 col-12">

                            <x-user.input type="number" wirevalue="product.price_seller" error="Debe indicar el precio por mayor">
                                Precio por mayor
                            </x-user.input>

                        </div>
                    </div>


                    {{-- Descripcion --}}

                    {{-- <div class="row">
                        <div class="col">
                            <label for="description">Descripcion</label>
                            <textarea id="description" class="form-control" wire:model="product.description"></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                    </div> --}}


                    {{-- fin del primer body (datos del producto) --}}


                    {{-- Tallas --}}

                    {{-- <div class="row">
                                    <div class="col">
                                        <label for="tallas">Tallas</label>
                                        <select class="form-select" name="tallas" id="">
                                            <option value="S,M,L">S,M,L</option>
                                            <option value="XS,S,M,L,XL">XS,S,M,L,XL</option>
                                            <option value="ESTANDAR">ESTANDAR</option>
                                        </select>
                                    </div>
                                </div> --}}


                    {{-- fin de tallas --}}

                </div>
                <div class="card-footer">
                    <div class="col mt-3 d-flex">

                        {{-- <button type="button" wire:loading.remove wire.target="save" wire:click="save"
                        class="btn btn-primary ml-auto">Guardar Cambios</button> --}}

                        {{-- <button type="button" wire:loading.remove wire.target="save" wire:click="save"
                        class="btn btn-primary ml-auto">Guardar Cambios</button> --}}

                        {{-- <button type="button" wire:loading.attr="disabled" wire.target="save" wire:click="save"
                            class="btn btn-primary ml-auto">Guardar Cambios</button> --}}

                        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save" wire:click="save"
                            class="btn btn-primary ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>

                        <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .ficha-producto .accordion-button {
                    /* display: block; */
                }

                .ficha-producto .title-button {
                    font-size: 1.6rem;
                    font-weight: bold;
                }
            </style>

            {{-- Boton de guardar --}}



            {{-- fin de Boton de guardar --}}
        </div>

    </section>
</div>
