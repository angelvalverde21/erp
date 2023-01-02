<div>

    <section class="col mb-3">

        {{-- cargarn --}}

        <div class="row" wire:ignore>

            <div class="col position-relative">
                <i class="fas fa-camera position-absolute top-50 start-50" style="font-size: 18pt;"></i>
                <form method="POST" action="{{ route('user.products.files', $product) }}" class="dropzone"
                    id="my-awesome-dropzone-images">

                </form>
            </div>

        </div>

        {{-- fin de cargarn --}}

    </section>

    <style>
        /* .contenedor{
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            gap: 20px;
        } */

        .contenedor {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(15rem , 1fr));
            /*3 columnas del tamaño de una fraccion*/
            gap: 20px;

        }

        .contenedor .card {
            margin-bottom: 0;
            min-height: 150px;
            position: relative;
        }

        .btn-eliminar-imagen{
            position: absolute;
            bottom: 10px;
            right: 20px;
        }
    </style>

    {{-- Stop trying to control. --}}
    @if ($product->images->count())

        {{-- <h1>Imagenes del producto --}}
        <div class="contenedor">

            @foreach ($product->images as $image)
                <div class="card">

                    <div class="image">
                        <img src="{{ Storage::url($image->url) }}"
                        alt="" width="100%" height="100%">

                    </div>

                        {{-- Boton para borrar --}}
                        <div class="btn-eliminar-imagen" wire:key="image-{{ $image->id }}">
                            <a style="font-size: 15pt; color:rgb(44, 44, 44)" href="#"  wire:click.prevent="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})"
                                ><i class="fa-solid fa-trash"></i></a>
                        </div>
                </div>
            @endforeach

        </div>

    @endif

{{-- 
    @if ($product->images->count())

        @foreach ($product->images as $image)


            <div class="accordion-item">

                <h2 class="accordion-header" id="flush-headingOne-{{ $image->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne-{{ $image->id }}" aria-expanded="false"
                        aria-controls="flush-collapseOne-{{ $image->id }}">

                        <ul class="d-flex align-items-center">
                            <li class="float-left mr-3"><img height="150px" src="{{ Storage::url($image->url) }}">
                            </li>
                        </ul>

                    </button>
                </h2>

                <div id="flush-collapseOne-{{ $image->id }}" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingOne-{{ $image->id }}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col-lg-4"><button class="btn btn-primary">Guardar
                                </button></div>

                            <div class="col-lg-4" wire:ignore>

                                <i class="fas fa-camera position-absolute top-50 start-50" style="font-size: 18pt;"></i>
                                <form method="POST" action="{{ route('user.products.editimage', $image) }}"
                                    class="dropzone" id="my-awesome-dropzone-images-edit">

                                </form>

                            </div>

                            <div class="col-lg-4">
                                <div class="float-right" wire:key="image-{{ $image->id }}">
                                    <button wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                        wire:target="deleteImage({{ $image->id }})"
                                        class="btn btn-danger">x</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

        @endforeach

    @endif --}}

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzoneImages = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "Agregar imagenes al producto",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshImages');
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
            Dropzone.options.myAwesomeDropzoneImagesEdit = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "Actualizar",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 10, //10MB max, Tambien hemos agregado un validador en el servidor
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshProduct');
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

</div>
