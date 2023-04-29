<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h4><i class="fa-solid fa-cart-flatbed mr-2"></i>( {{ $product->quantity }} ) Productos en almacen</h4>

    {{-- cargar imagen --}}

    <div class="row pb-3" wire:ignore>

        <div class="col position-relative">
            <form method="POST" action="{{ route('manage.products.upload.colors', [$store->nickname, $product]) }}"
                class="dropzone" id="my-awesome-dropzone-colors">
            </form>
        </div>

    </div>

    {{-- fin de cargar imagen --}}

    <h4>{{ $colors->count() }} disenos disponibles</h4>

    @if ($colors->count())

        <div class="table-responsive">


            <table class="table">

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
                    @foreach ($colors as $color)
                        <tr class="text-center">
                            <td class="text-center">{{ $color->id }}</td>
                            <td>
                                {{-- boton para el stock --}}
                                <button class="btn btn-success" data-toggle="modal"
                                    data-target="#editarStock-{{ $color->id }}" type="button"><i
                                        class="fa-solid fa-barcode me-1"></i> Stock</button>
                            </td>

                            @if ($color->image)
                                <td>
                                    {{-- boton para las variantes --}}

                                    <a href="{{ Storage::url($color->image->name) }}" data-lightbox="colors"
                                        data-title="Stock: {{ $color->quantity }}">
                                        <img src="{{ Storage::url($color->image->name) }}" alt="" width="100px"
                                            height="100%">
                                    </a>
                                    <p>({{ $color->quantity }})</p>
                                    <p>({{ $color->label }})</p>
                                    {{-- <a href="#" class="btn btn-secondary">Agregar info</a> --}}

                                    {{-- Mostrar como modal de bootstrap --}}

                                    {{-- <a href="#" data-toggle="modal" data-target="#zoom-{{ $color->id }}">
                                        <img src="{{ Storage::url($color->image->name) }}" alt="" width="100px"
                                            height="100%">
                                    </a>

                                    <x-modal title="Zoom" id="zoom-{{ $color->id }}" size="modal-lg">

                                        <img src="{{ Storage::url($color->image->name) }}" alt="" width="100%" height="100%">

                                    </x-modal> --}}

                                    {{-- fin de mostrar como modal de bootstrap --}}
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

                {{-- modal para agregar variantes de la imagen --}}

                {{-- <x-modal title="Agregar variantes" id="addImagesColor{{ $color->id }}" size="modal-lg">

                    <div class="zoom-color">
                        <div wire:ignore class="drop-zoom" wire:key="color-variants-form-upload-{{ $color->id }}">

                            <form method="POST"
                                action="{{ route('manage.products.upload.colors.variants', [$store->nickname, $color]) }}"
                                class="dropzone" id="my-awesome-dropzone-variants-colors-edit">
                            </form>

                        </div>
                    </div>

                    <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" wire:model.debounce.500ms="color.name"
                            placeholder="Color" aria-label="Color" aria-describedby="basic-addon1">
                    </div>

                    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled"
                        wire.target="save" wire:click="save" class="btn btn-success ml-auto"><i
                            class="fa-solid fa-floppy-disk mr-1"></i> Guardar
                        Cambios</button>

                    <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>


                    <table class="table table-striped mt-3">
                        <tr>
                            <td>#</td>
                            <td>Color</td>
                            <td>Created at</td>
                            <td></td>
                        </tr>

                        @if ($color->images->count() == 1)
                            @foreach ($color->images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td><img src="{{ Storage::url($image->name) }}" width="100px" height="100%"
                                            alt="">
                                    </td>
                                    <td>{{ $image->created_at }}</td>
                                    <td wire:key="color-variante-{{ $image->id }}" class="text-center">
                                        Para borrar, Agregue otra imagen
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($color->images as $image)
                                <tr>
                                    <td>{{ $image->id }}</td>
                                    <td><img src="{{ Storage::url($image->name) }}" width="100px" height="100%"
                                            alt="">
                                    </td>
                                    <td>{{ $image->created_at }}</td>
                                    <td wire:key="color-variante-{{ $image->id }}" class="text-center">
                                        <a class="btn-color" href="#"
                                            wire:click.prevent="deleteVarianteColor({{ $image->id }})"
                                            wire:loading.attr="disabled"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </x-modal> --}}

            @endforeach

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

    {{-- <script>
        Dropzone.options.myAwesomeDropzoneVariantsColorsEdit = {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "<div>Actualizar color</div> <i class=\"fas fa-camera mt-5\" style=\"font-size: 18pt;\"></i>",
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
            init: function() {

                console.log('init');

                var myDropzone = this;

                this.on("sending", function(data, xhr, formData) {
                    formData.append("total_amount", jQuery("#total_amount").val());
                    9
                    console.log('sending');
                });


            },
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('refreshColor');
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    </script> --}}
@endpush
