<div>
    {{-- In work, do what you enjoy. --}}

    <style>
        .dz-preview {
            margin: 10px !important
        }
    </style>

    <x-sectioncontent>

        @livewire('components.locations.create-location', ['album' => $album, 'reloadUrl' => true], 'location-album-' . $album->id)


    </x-sectioncontent>

    {{-- <x-sectioncontent>

        <div class="card">
            <div class="card-header">Mirador Bresciani, Barranco</div>
            <div class="card-body">


            </div>
        </div>

    </x-sectioncontent> --}}

    {{-- <x-sectioncontent>

        <div class="row pb-3" wire:ignore>

            <div class="col position-relative">
                <form method="POST" action="{{ route('manage.albums.upload', [$store->nickname, $album]) }}"
                    class="dropzone d-flex flex-wrap justify-content-around p-3" id="my-awesome-dropzone-albums">
                </form>
            </div>

        </div>

    </x-sectioncontent> --}}

    <x-sectioncontent>

        <div class="accordion" id="accordionAlbum">

            {{-- Ojo esta linea consulta en la tabla usuarios a los carriers (courier) --}}

            @if ($album->locations->count() > 0)

                @foreach ($album->locations as $location)
                    <x-accordion-item id="item-album-location-{{ $location->pivot->id }}" show="{{ $loop->first }}"
                        label="{{ $location->name }} ({{ albumLocation($album->id, $location->id)->images->count() }})"
                        accordion_parent_id="accordionAlbum">
                        <div class="row pb-3" wire:ignore>

                            <div class="title">
                                <h3>{{ $location->name }}, {{ $location->district->name }}</h3>
                            </div>

                            <div class="col position-relative">

                                <form method="POST" wire:ignore.self
                                    action="{{ route('manage.albums.upload', [$store->nickname, $album, $location]) }}"
                                    class="dropzone d-flex flex-wrap justify-content-around p-3"
                                    id="my-awesome-dropzone-albums">
                                </form>
                            </div>

                            <div class="mt-3 album d-flex flex-wrap justify-content-around">

                                @foreach (albumLocation($album->id, $location->id)->photos as $photo)
                                    {{-- 
                            Image->name: {{ $image->name }}
                
                            <br /> --}}

                                    <div class="card text-center" style="width: 155px">

                                        <a href="{{  Storage::disk('spaces')->url($photo->medium) }}" data-lightbox="show-images-preview"
                                            data-title="{{ $photo->name }}">

                                            <img src="{{  Storage::disk('spaces')->url($photo->thumbnail) }}" class="card-img-top" height="" alt="...">
                                        </a>

                                        <span>{{ $photo->name }}</span>

                                        <a target="_blank" href="{{  Storage::disk('spaces')->url($photo->large) }}" class="btn btn-primary"><i class="fa-solid fa-download"></i></a>
   
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

                        </div>
                    </x-accordion-item>
                @endforeach
            @else
                No hay locaciones para mostrar, antes de subir las fotos cree una locacion
            @endif


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

    <script>
        $(document).ready(function() {

            Livewire.on('reloadUrl', function() {
                // Obtener el elemento Dropzone

                window.location.reload()
            });

        });
    </script>
@endpush
