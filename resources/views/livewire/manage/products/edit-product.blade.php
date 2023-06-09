{{-- @extends('layouts.manage') --}}
<div>
    {{-- The whole world belongs to you. --}}
    {{-- {{$product->id}} --}}

    <style>
        .dropzone {
            /* height: 100%; */
            border: 2px dotted rgba(0, 0, 0, .3);
        }
    </style>

    <style>
        /* .contenedor{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        gap: 20px;
    } */

        .contenedor {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(15rem, 1fr));
            /*3 columnas del tamaño de una fraccion*/
            gap: 20px;

        }

        .contenedor .card {
            margin-bottom: 0;
            min-height: 150px;
            position: relative;
        }

        .btn-eliminar-color {
            position: absolute;
            bottom: 10px;
            right: 20px;
        }

        .edit-color {
            position: absolute;
            bottom: 10px;
            left: 20px;
        }

        .btn-color {
            font-size: 15pt;
            color: rgb(44, 44, 44);
        }

        .zoom-color {
            position: relative;
        }

        .drop-zoom {
            position: absolute;
            bottom: 0px;
            width: 100%;

        }

        .drop-zoom form {
            opacity: 0.75;

        }
    </style>

    <x-breadcrumbs title="{{ $product->name }}" />


    <x-sectioncontent>

        <div class="margin-correction mt-3 d-block d-sm-block d-md-none d-lg-none d-xl-none d-xxl-none"></div>

        <div class="row">

            {{-- Bloque principal --}}

            <div class="col-lg-8 col-12">

                {{-- Almacen --}}
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"
                                    role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                        class="hidden-xs-down">Inventario</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                    role="tab"><span class="hidden-sm-up"><i class="ti-image"></i></span> <span
                                        class="hidden-xs-down">Fotos</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages"
                                    role="tab"><span class="hidden-sm-up"><i class="ti-gallery"></i></span> <span
                                        class="hidden-xs-down">Sessiones ({{ $product->albums->count() }})</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active py-3" id="home" role="tabpanel">
                                {{-- Inventario --}}
                                @livewire('manage.products.edit-product.colors', ['product' => $product], key('product-colors-' . $product->id))
        
                            </div>
                            <div class="tab-pane  py-3" id="profile" role="tabpanel">
        
                                @livewire('manage.products.edit-product.images', ['product' => $product], key('product-images-' . $product->id))
                            </div>
        
                            <div class="tab-pane py-3" id="messages" role="tabpanel">
        
                                @livewire('manage.products.edit-product.show-albums', ['product' => $product], key('product-show-albums-' . $product->id))
                            </div>
        
                        </div>
                    </div>
                </div>
                {{-- Fin de almacen --}}
            </div>
            
            {{-- sidebar  --}}

            <div class="col-lg-4 col-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        {{-- Editar Producto --}}
                        <div class="card">
                            <div class="card-header py-3">
                                Publicado en: {{ $product->category->name }}
                            </div>
                            <div class="card-body">
                                <form action="#">
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-12 p-y-3">
                                                @if ($store->getOption('domain'))
                                                    <p><a target="_blank"
                                                            href="https://{{ $store->getOption('domain') }}/{{ $product->short_link }}">https://{{ $store->getOption('domain') }}/{{ $product->short_link }}</a>
                                                    </p>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <x-form.input type="text" wirevalue="product.name" debounce="1000"
                                                    error="Este campo es requerido">
                                                    Titulo
                                                </x-form.input>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <x-form.input type="hidden" disabled="disabled"
                                                    wirevalue="product.slug" error="este producto ya existe">
                                                    Url del producto
                                                </x-form.input>
                                            </div>
                                        </div>

                                        <div class="accordion-content" wire:ignore>
                                            <div class="accordion mb-3" id="accordionExample">

                                                <x-accordion-item label="Descripcion del producto"
                                                    id="description_product" accordionParentId="accordionExample">

                                                    <x-form.textarea wirevalue="product.description" rows="5">
                                                        Describa al producto
                                                    </x-form.textarea>

                                                </x-accordion-item>

                                                <x-accordion-item id="labels_product"
                                                    accordionParentId="accordionExample" label="Etiquetas del producto">

                                                    <x-form.textarea wirevalue="product.tags" rows="3">
                                                        Etiquetas del producto
                                                    </x-form.textarea>

                                                </x-accordion-item>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <x-form.input type="number" label="Precio Costo" texticon="S/. "
                                                    wirevalue="product.costo" debouce="500"
                                                    error="Este campo es requerido">
                                                    Precio Costo
                                                </x-form.input>
                                            </div>
                                            <div class="col-md-4">
                                                <x-form.input type="number" label="Precio Normal" texticon="S/. "
                                                    wirevalue="product.price" debouce="500"
                                                    error="Este campo es requerido">
                                                    Precio Costo
                                                </x-form.input>
                                            </div>
                                            <div class="col-md-4">
                                                <x-form.input type="number" label="Precio Mayor" texticon="S/. "
                                                    wirevalue="product.price_seller" debouce="500"
                                                    error="Debe indicar el precio por mayor">
                                                    Precio por mayor
                                                </x-form.input>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                        wire:model.debounce.500ms="product.over_sale" type="checkbox"
                                                        role="switch" id="flexSwitchCheckDefault1">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Sobre
                                                        Vender</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                        wire:model.debounce.500ms="product.force_size_unique"
                                                        type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Vender
                                                        como una
                                                        sola talla (ESTANDAR)</label>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                    </div>

                                    <div class="botones d-flex justify-content-between mt-3">
                                        <div class="form-actions">
                                            <button type="button" wire:loading.attr="disabled" wire.target="save"
                                                wire:click="save" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Guardar
                                                Cambios</button>
                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                        </div>

                                        <div wire:loading wire:target="save" class="spinner-border" role="status">
                                            <span class="sr-only">Espere...</span>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        {{-- FIN de editar Producto --}}
                    </div>

                    <div class="col-lg-12 col-12">
                        {{-- Lista de precios --}}
                        @livewire('components.prices.show-prices', ['product' => $product], key('show-prices-' . $product->id))
                        {{-- FIN de lista de precios --}}

                        {{-- texto paa publicar en redes --}}
                        <div class="alert alert-light" role="alert">
                            <ul>
                                <li>{{ $product->name }}</li>
                                <li>Por solo: S/. {{ $product->prices->first()->value }}</li>
                                <li>Tambien: {{ $product->price_oferta() }}</li>
                                <li>Envio GRATIS a todo el Peru</li>
                            </ul>

                        </div>
                        {{-- FIN texto paa publicar en redes --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-7 col">



            </div>

            <div class="col-lg-5 col">


            </div>

        </div>

    </x-sectioncontent>

    {{-- <x-sectioncontent>

        <a href="{{ route('manage.products.download.zip', [$store->nickname, $product->id]) }}" class="btn btn-success mb-3">Descargar Stock</a>
        

    </x-sectioncontent> --}}

    <x-sectioncontent>


    </x-sectioncontent>



</div>
