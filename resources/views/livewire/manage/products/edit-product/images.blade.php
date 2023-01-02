<div>

    {{-- cargar imagenes para la web --}}

    <div class="row pb-3" wire:ignore>

        <div class="col position-relative">

            <form method="POST" action="{{ route('manage.products.images', [$store->nickname, $product]) }}" class="dropzone"
                id="my-awesome-dropzone-images">

            </form>
        </div>

    </div>

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
                        <img src="{{ $image->name }}"
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


    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzoneImages = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "<div>Agregar fotos para la portada de este producto</div> <i class=\"fas fa-camera mt-15\" style=\"font-size: 18pt;\"></i>",
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

    @endpush

</div>
