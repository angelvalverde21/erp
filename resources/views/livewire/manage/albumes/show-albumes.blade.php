<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <style>
        .albumes {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1rem;


        }

        .albumes .card {}

        .albumes .title {}
    </style>

    <section class="content-header d-none d-md-block">
        <div class="container-fluid d-flex justify-content-between align-items-center">


            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('manage.albumes.album', [$store->nickname, 0]) }}">ALBUMES</a>
                </li>
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item"><a
                            href="{{ route('manage.albumes.album', [$store->nickname, $breadcrumb['id']]) }}">{{ Str::upper($breadcrumb['name']) }}</a>
                    </li>
                @endforeach


            </ol>

        </div><!-- /.container-fluid -->
    </section>


    <x-sectioncontent>


        <div class="content-controls" wire:ignore>


            @if (isset($album_id))
                <div class="content-form">
                    <form method="POST" wire:ignore.self
                        action="{{ route('manage.albumes.upload', [$store->nickname, $album_id]) }}"
                        class="dropzone d-flex flex-wrap justify-content-around p-3" id="my-awesome-dropzone-albums">
                    </form>
                </div>
            @endif


            <button class="btn btn-success mt-3" style="width: 145px;" data-toggle="modal" data-target="#addAlbum"
                type="button">+
                Agregar Carpeta</button>

        </div>

        <script>
            Dropzone.options.myAwesomeDropzoneAlbums = {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: "<div class='add-photos'>Agregar + fotos al album </div> <i class=\"fas fa-camera mt-5\" style=\"font-size: 18pt;\"></i>",
                // acceptedFiles: "image/*",
                acceptedFiles: "*.jpg, .jpeg, .JPG, .JPEG",
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

        <div class="albumes mt-3">

            @foreach ($albumes as $album)
                {{-- {{ $album }} --}}

                <div class="card text-center ">

                    <a href="{{ route('manage.albumes.album', [$store->nickname, $album->id]) }}">
                        <img class="p-3" src="{{ Storage::url('file.png') }}" alt="">
                    </a>

                    <div class="title text-center pb-3">
                        <h5>{{ $album->name }}</h5>
                    </div>

                </div>
            @endforeach
        </div>

    </x-sectioncontent>

    <x-modal id="addAlbum">

        <x-form.input type="text" wirevalue="name" icon="fa-solid fa-font" debounce="250">
            Nombre carpeta
        </x-form.input>

        <p>Albumes/{{ $name }}</p>

        <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="createPath"
            wire:click="createPath" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i> Crear
            Carpeta</button>

        <div class="spinner-border" wire:loading.flex wire:target="createPath" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        {{-- <x-form.input type="number" wirevalue="albumes.parent_id" icon="fa-solid fa-link">
            Nombre carpeta
        </x-form.input> --}}

    </x-modal>

    <x-sectioncontent>

        <div class="d-flex flex-wrap justify-content-around">
            @foreach ($album->photos as $photo)
                <div class="card text-center" style="width: 340px">

                    <a href="{{ Storage::disk('spaces')->url($photo->medium) }}" data-fancybox="gallery"
                        data-caption="{{ $photo->name }}">

                        <img loading="lazy" src="{{ Storage::disk('spaces')->url($photo->medium) }}"
                            class="card-img-top" height="" alt="...">
                    </a>

                    <span>{{ $photo->name }}</span>

                    <div class="controles d-flex justify-content-between p-3">

                        {{-- <a href="{{ route('manage.download.photo', [$store->nickname, $photo->id]) }}" class="btn btn-success">Descargar</a> --}}

                        <a target="_blank" href="{{ Storage::disk('spaces')->url($photo->large) }}"
                            class="btn btn-success"><i class="fa-solid fa-download me-1"></i>
                            Descargar</a>

                        @if ($user->hasRole('admin'))
                            <button type="button" wire:loading.attr="disabled"
                                wire.target="delete-{{ $photo->id }}" wire:click="delete('{{ $photo->large }}')"
                                class="btn btn-danger">
                                <i class="fa-solid fa-trash me-1"></i>Borrar</button>

                            <div wire:loading wire:target="delete-{{ $photo->id }}" class="spinner-border"
                                role="status">
                                <span class="sr-only">Espere...</span>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

    </x-sectioncontent>

</div>
