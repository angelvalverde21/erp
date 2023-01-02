<div>

    {{-- cargar imagenes para la web --}}

    <div class="row pb-3" wire:ignore>

        <div class="col position-relative">

            <form method="POST" action="{{ route('manage.post.profile.carousel', [$store->nickname, 'carousel']) }}" class="dropzone" 
                id="my-awesome-dropzone-images">
            </form> 

        </div>

    </div>

    {{-- Stop trying to control. --}}
    @if ($store->carousel->count())

        <div class="card">
            <!-- ./card-header -->
            <div class="card-body p-0">

                <table class="table table-hover">
                    <tbody>

                        @foreach ($store->carousel as $carousel)
                            <tr>
                                <td><img src="{{ $carousel->image }}" alt="" height="100%" style="max-height: 200px"></td>
                                <td>
                                    <div class="controles">
                                        <div class="title">
                                            <x-form.input wirevalue="carousel.{{ $carousel->id }}.title" icon="fa-solid fa-heading">
                                                Titulo
                                            </x-form.input>
                                        </div>
                                        <div class="title">
                                            <x-form.textarea id="id-{{ $carousel->id }}" wirevalue="carousel.{{ $carousel->id }}.sub_title" icon="fa-solid fa-heading">
                                                Sub Titulo
                                            </x-form.textarea>
                                        </div>
                                        <div class="title">
                                            <x-form.input wirevalue="carousel.{{ $carousel->id }}.slug" icon="fa-solid fa-link">
                                                Slug
                                            </x-form.input>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire:click="deleteItem( {{ $carousel->id }} )" wire.target="save" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

            <div class="card-footer">
                <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire:click="saveAll" wire.target="save" class="btn btn-success mr-2"><i class="fa-solid fa-save"></i>
                    Guardar</button>

                    <div class="spinner-border" wire:loading.flex wire:target="save" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->




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
                    Livewire.emit('refreshCarousel');
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
