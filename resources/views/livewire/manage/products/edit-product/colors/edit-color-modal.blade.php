<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addImagesColor{{ $color->id }}">
        Editar Color
    </a>
    <p>Agregue fotos del mismo color pero actuales</p>

    {{-- modal para agregar variantes de la imagen --}}

    <x-modal title="Agregar variantes" id="addImagesColor{{ $color->id }}" size="modal-lg">

        <div class="zoom-color">
            <div wire:ignore class="drop-zoom" wire:key="color-variants-form-upload-{{ $color->id }}">

                <form method="POST"
                    action="{{ route('manage.products.upload.colors.variants', [$store->nickname, $color]) }}"
                    class="dropzone" id="my-awesome-dropzone-variants-colors-edit">
                </form>

            </div>
        </div>

        <div class="input-group mb-3 mt-3">
            <input type="text" class="form-control" wire:model.debounce.500ms="color.label" placeholder="Color"
                aria-label="Color" aria-describedby="basic-addon1">
        </div>

        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
            wire:click="save" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
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
                        <td><img src="{{ Storage::url($image->name) }}" width="100px" height="100%" alt="">
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
                        <td><img src="{{ Storage::url($image->name) }}" width="100px" height="100%" alt="">
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
    </x-modal>

    @push('script')
        <script>
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
        </script>
    @endpush

</div>
