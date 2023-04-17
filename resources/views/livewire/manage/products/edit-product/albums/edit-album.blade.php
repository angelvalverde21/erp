<div>
    {{-- In work, do what you enjoy. --}}

    <x-breadcrumbs title="Album" />

    <x-sectioncontent>


        <div class="row pb-3" wire:ignore>

            <div class="col position-relative">
                <form method="POST" action="{{ route('manage.albums.upload', [$store->nickname, $album]) }}"
                    class="dropzone" id="my-awesome-dropzone-albums">
                </form>
            </div>

        </div>


    </x-sectioncontent>

    <x-sectioncontent>

        <div class="album d-flex flex-wrap justify-content-around">

            @foreach ($album->images as $image)
                {{-- 
            Image->name: {{ $image->name }}

            <br /> --}}


                <div class="card" style="width: 360px">
                    <img src="{{ $image->nameS3Thumb }}" class="card-img-top" alt="...">
                    {{-- <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div> --}}
                </div>



                {{-- <br />

            <br /> --}}


                {{-- {{ Storage::disk('s3')->url($image->nameS3);  }} --}}

                {{-- {{ Storage::url('albums/Bk21lU3tXUDYRyFKzhwG3QKvg9YlVQ38fnPZCV3s.jpg') }} --}}
            @endforeach

        </div>

    </x-sectioncontent>

</div>

@push('script')
    <script>
        Dropzone.options.myAwesomeDropzoneAlbums = {
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
