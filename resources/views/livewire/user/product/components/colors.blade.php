<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h4><i class="fa-solid fa-cart-flatbed mr-2"></i>Almacen ( {{ $product->stock }} )</h4>

    {{-- <h3 class="my-2">Stock Super Total:  {{ $product->stock }}</h3> --}}

    <style>
        .dropzone {
            /* height: 100%; */
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


    </style>


    
    <section class="col my-3">

        {{-- cargar imagen --}}

        <div class="row" wire:ignore>

            <div class="col position-relative">
                
                <form method="POST" action="{{ route('user.products.colors', $product) }}" class="dropzone"
                    id="my-awesome-dropzone-colors">

                </form>
            </div>

        </div>

        {{-- fin de cargar imagen --}}

    </section>


    @if ($product->colors->count())

        <div class="contenedor">

            @foreach ($product->colors as $color)
                <div class="card">

                    <div class="color">
                        <a href="#" data-toggle="modal" data-target="#editarColor-{{ $color->id }}"><img
                                src="{{ Storage::url($color->file_name) }}" alt="" width="100%"
                                height="100%"></a>
                    </div>

                    {{-- Boton para borrar --}}
                    <div class="edit-color"><span class="badge badge-light">{{ $color->stock }}</span>
                        {{-- <a class="btn-color"  data-toggle="modal" data-target="#editarColor-{{ $color->id }}" href="#"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                    </div>

                    <div class="btn-eliminar-color" wire:key="colxor-{{ $color->id }}">
                        <a class="btn-color" href="#" wire:click.prevent="deleteColor({{ $color->id }})"
                            wire:loading.attr="disabled" wire:target="deleteColor({{ $color->id }})"><i
                                class="fa-solid fa-trash"></i></a>
                    </div>

                </div>

                <x-user.modal title="Editar archivo" id="editarColor-{{ $color->id }}" size="modal-lg">

                    <div class="zoom-color">
                        <img src="{{ Storage::url($color->file_name) }}" alt="" width="100%" height="100%">
                        {{-- cuadro para actualizar la imagen --}}
                        <div wire:ignore class="drop-zoom " wire:key="color-form-upload-{{ $color->id }}">
                            <form method="POST" action="{{ route('user.products.edit-color', $color) }}"
                                class="dropzone" id="my-awesome-dropzone-colors-edit">

                            </form>
                        </div>
                    </div>

                    {{-- Cuadro de tallas y stock --}}

                    <div class="row">
                        <div class="col-lg-12 col">
                            <div class="card">
                                <div class="card-body">
                                    @livewire('user.product.components.stock-color-size', ['color' => $color], key('stock-color-size-' . $color->id))
                                </div>
                            </div>

                        </div>
                    </div>

                    <x-slot name="footer">

                    </x-slot>

                </x-user.modal>

            @endforeach

        </div>

    @endif

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzoneColors = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "<div>Agregar colores</div> <i class=\"fas fa-camera mt-15\" style=\"font-size: 18pt;\"></i>",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
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
        </script>

        <script>
            Dropzone.options.myAwesomeDropzoneColorsEdit = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "<div>Actualizar color</div> <i class=\"fas fa-camera mt-15\" style=\"font-size: 18pt;\"></i>",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
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
        </script>
    @endpush
</div>
