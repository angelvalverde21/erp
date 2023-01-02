<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h4><i class="fa-solid fa-cart-flatbed mr-2"></i>( {{ $product->stock }} ) Productos en almacen</h4>

    {{-- cargar imagen --}}

    <div class="row pb-3" wire:ignore>

        <div class="col position-relative">
            <form method="POST" action="{{ route('manage.products.colors', [$store->nickname, $product]) }}"
                class="dropzone" id="my-awesome-dropzone-colors">
            </form>
        </div>

    </div>

    {{-- fin de cargar imagen --}}

    @if ($product->colors->count())

        <table class="table">
            <thead>
                <tr>
                    <td class="text-center">Codigo</td>
                    <td>Color</td>
                    <td>Stock</td>
                    <td class="text-center">Eliminar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($product->colors as $color)
                    <tr>
                        <td class="text-center">{{ $color->id }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editarColor-{{ $color->id }}"><img
                                    src="{{ $color->image }}" alt="" width="100px"
                                    height="100%">
                            </a>
                        </td>

                        <td>{{ $color->stock }}</td>
                        <td wire:key="colxor-{{ $color->id }}" class="text-center">
                            <a class="btn-color" href="#" wire:click.prevent="deleteColor({{ $color->id }})"
                                wire:loading.attr="disabled" wire:target="deleteColor({{ $color->id }})"><i
                                    class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="contenedor">

            @foreach ($product->colors as $color)
                {{-- <div class="card">

                    <div class="color">
                        <a href="#" data-toggle="modal" data-target="#editarColor-{{ $color->id }}"><img
                                src="{{ Storage::url($color->file_name) }}" alt="" width="100%"
                                height="100%"></a>
                    </div>

                    <div class="edit-color"><span class="badge badge-light">{{ $color->stock }}</span>
                    </div>

                    <div class="btn-eliminar-color" wire:key="colxor-{{ $color->id }}">
                        <a class="btn-color" href="#" wire:click.prevent="deleteColor({{ $color->id }})"
                            wire:loading.attr="disabled" wire:target="deleteColor({{ $color->id }})"><i
                                class="fa-solid fa-trash"></i></a>
                    </div>

                </div> --}}

                <x-modal title="Editar archivo" id="editarColor-{{ $color->id }}" size="modal-lg">

                    <div class="zoom-color">
                        <img src="{{ $color->image }}" alt="" width="100%" height="100%">
                        {{-- cuadro para actualizar la imagen --}}
                        <div wire:ignore class="drop-zoom " wire:key="color-form-upload-{{ $color->id }}">
                            {{-- OJO NO PASAMOS LA VARIABLE PRODUCT_ID PORQUE LOS COLORES SON UNICOS --}}
                            <form method="POST"
                                action="{{ route('manage.products.editcolor', [$store->nickname, $color]) }}"
                                class="dropzone" id="my-awesome-dropzone-colors-edit">

                            </form>
                        </div>
                    </div>

                    {{-- Cuadro de tallas y stock --}}

                    <div class="row">
                        <div class="col-lg-12 col">
                            <div class="card">
                                <div class="card-body">
                                    @livewire('manage.products.edit-product.stock-color-size', ['color' => $color], key('stock-color-size-' . $color->id))
                                </div>
                            </div>

                        </div>
                    </div>

                    <x-slot name="footer">

                    </x-slot>

                </x-modal>
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
