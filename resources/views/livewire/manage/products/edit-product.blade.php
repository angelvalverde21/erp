<div>
    {{-- The whole world belongs to you. --}}
    {{-- {{$product->id}} --}}

    <style>
        .dropzone {
            /* height: 100%; */
            border: 2px dotted rgba(0,0,0,.3);
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

        .drop-zoom form{
            opacity: 0.75;

        }
    </style>

    <x-breadcrumbs title="Editar producto" />

    <x-sectioncontent>
        <div class="card">
            {{-- <div class="card-header">
                <h4 class="m-b-0">Complete la informacion</h4>
            </div> --}}
            <div class="card-body">
                <form action="#">
                    <div class="form-body">
                        
                        <div class="row">
                            <div class="col-md-12 p-y-3">
                            <p> Publicado en: {{ $product->category->name }}</p>
                            </div>
                        </div>

                        <div class="row p-t-20">
                            <div class="col-md-12">
                                <x-form.input type="text" wirevalue="product.name"
                                    error="Este campo es requerido">
                                    Titulo
                                </x-form.input>
                            </div>
                        </div> 
                        
                        <div class="row">
                            <div class="col-md-12">
                                <x-form.input type="hidden" wirevalue="product.slug"
                                    error="este producto ya existe">
                                    Url del producto
                                </x-form.input>
                            </div>
                        </div>

                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <x-form.input type="number" label="Precio Normal" texticon="S/. " wirevalue="product.price"
                                    error="Este campo es requerido">
                                    Precio Normal
                                </x-form.input>
                            </div>
                            <div class="col-md-6">
                                <x-form.input type="number" label="Precio Mayor" texticon="S/. "  wirevalue="product.price_seller"
                                    error="Debe indicar el precio por mayor">
                                    Precio por mayor
                                </x-form.input>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->


                    </div>

                    <div class="botones d-flex justify-content-between">
                        <div class="form-actions">
                            <button type="button" wire:loading.attr="disabled" wire.target="save"
                                wire:click="save" class="btn btn-success"> <i class="fa fa-check"></i> Guardar
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
    </x-sectioncontent>

    <x-sectioncontent>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"
                            role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                class="hidden-xs-down">Inventario</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span
                                class="hidden-sm-up"><i class="ti-image"></i></span> <span
                                class="hidden-xs-down">Fotos</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages"
                            role="tab"><span class="hidden-sm-up"><i class="ti-gallery"></i></span> <span
                                class="hidden-xs-down">Album</span></a> </li>
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
                    <div class="tab-pane py-3" id="messages" role="tabpanel">Aqui ira el album de fotos</div>
                </div>
            </div>
        </div>
    </x-sectioncontent>

</div>