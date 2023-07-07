<div>
    {{-- Because she competes with no one, no one can compete with her. --}}


    <div class="head-color d-flex justify-content-between">

        <h6><i class="fa-solid fa-cart-flatbed mr-2"></i>( {{ $product->quantity }} ) Productos en almacen</h6>

        {{-- cargar imagen --}}
    
        {{-- fin de cargar imagen --}}
    
        <h6>{{ $colors->count() }} disenos disponibles</h6>
    </div>

    @if ($colors->count()>0)

        <div class="input-group mb-3">
            <input type="text" class="form-control buscar_table" placeholder="Buscar Color">
            <div class="input-group-append">
                <span class="input-group-text">
                    <li class="material-icons">search</li>
                </span>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-striped dataTable dtr-inline">

                <thead>
                    <tr>
                        <td class="text-center">Codigo</td>
                        <td class="text-center">Agregar Stock</td>
                        <td class="text-center">Colores</td>
                        <td class="text-center">Variantes</td>
                        <td class="text-center">Eliminar</td>
                    </tr>
                </thead>

                <tbody>
                    

                    <tr class="text-center">
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <div class="row p-3" wire:ignore>

                                <form method="POST" action="{{ route('manage.products.upload.colors', [$store->nickname, $product]) }}"
                                    class="dropzone" id="my-awesome-dropzone-colors">
                                </form>
                        
                            </div>
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>

                    @foreach ($colors as $color)
                    
                        <tr class="text-center">
                            <td class="text-center">{{ $color->id }}</td>
                            <td>
                                {{-- boton para el stock --}}
                                <button class="btn btn-success" style="width: 115px;" data-toggle="modal"
                                    data-target="#editarStock-{{ $color->id }}" type="button" class="d-flex justify-content-between align-items-center"><i
                                        class="fa-solid fa-barcode me-1"></i><span>Editar Stock</span></button>

                                        <table class="table mt-3">

                                            @foreach ($color->sizes as $size)
                                            <tr>
                                                <td>{{ $size->name }}</td>
                                                <td>{{ $size->pivot->quantity }}</td>
                                            </tr>      
                                            @endforeach
                                        </table>
                            </td>

                            @if ($color->image)
                                <td>
                                    {{-- boton para las variantes --}}

                                    <a href="{{ Storage::url($color->image->name) }}" data-lightbox="colors"
                                        data-title="Stock: {{ $color->quantity }}">
                                        <img loading="lazy" src="{{ Storage::url($color->image->name) }}" alt="" width="100px"
                                            height="100%">
                                    </a>

                                    <div>({{ $color->quantity }})</div>

                                    @if ($color->label != '')
                                        <div>({{ $color->label }})</div>
                                    @endif

                                </td>

                                <td>

                                    @livewire('manage.products.edit-product.colors.edit-color-modal', ['color' => $color, 'store' => $store], key('edit-color-' . $color->id))

                                    {{-- <a class="btn btn-primary" href="#" data-toggle="modal"
                                        data-target="#addImagesColor{{ $color->id }}">
                                        Editar Color
                                    </a>
                                    <p>Agregue fotos del mismo color pero actuales</p> --}}

                                </td>
                            @else
                                <td>
                                    No hay imagen
                                </td>

                                <td>

                                </td>
                            @endif

                            {{-- <td>
                                <a href="{{ route('manage.products.download.stock', [$store->nickname, $color->product_id]) }}" class="btn btn-secondary">Descargar Stock</a>
                            </td> --}}

                            <td wire:key="color-{{ $color->id }}" class="text-center">
                                <a class="btn-color" href="#"
                                    wire:click.prevent="deleteColor({{ $color->id }})" wire:loading.attr="disabled"
                                    wire:target="deleteColor({{ $color->id }})"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="contenedor">

            @foreach ($colors as $color)
                {{-- modal para agregar el stock --}}

                <x-modal title="Editar Stock" id="editarStock-{{ $color->id }}" size="modal-lg">

                    <div class="row text-center">
                        <div class="col-lg-4 col-12">
                            @if ($color->image)
                                <img src="{{ Storage::url($color->image->name) }}" alt="" width="100%"
                                    height="100%">
                            @endif
                        </div>

                        <div class="col-lg-8 col-12">
                            @livewire('manage.products.edit-product.stock-color-size', ['color' => $color], key('stock-color-size-' . $color->id))
                        </div>
                    </div>

                </x-modal>

            @endforeach

        </div>

    @else

        <div class="row p-3" wire:ignore>

            <form method="POST" action="{{ route('manage.products.upload.colors', [$store->nickname, $product]) }}"
                class="dropzone" id="my-awesome-dropzone-colors">
            </form>
    
        </div>

    @endif


    {{-- @push('script')

    @endpush --}}

</div>

@push('script')
    <script>
        Dropzone.options.myAwesomeDropzoneColors = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "<div>Agregar colores</div> <i class=\"fas fa-camera mt-5\" style=\"font-size: 18pt;\"></i>",
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('render');
                //OJO REFRESCAMOS LA PAGINA PARA QUE DROPZONE VUELVA A LEER LOS NUEVOS FORMULARIOS AGREGADOS DINAMICAMENTE
                window.location.reload()
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    </script>

@endpush
