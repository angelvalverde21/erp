<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <style>
        .albumes {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1rem;


        }

        .albumes .card {

        }

        .albumes .title {

        }
    </style>

    <x-breadcrumbs title="Albumes" />

    <x-sectioncontent>



        <button class="btn btn-success" style="width: 145px;" data-toggle="modal" data-target="#addAlbum" type="button">+
            Agregar Carpeta</button>

        <div class="albumes mt-3">

            @foreach ($albumes as $album)
                {{-- {{ $album }} --}}

                <div class="card text-center ">

                    <a href="{{ route('manage.albumes.album', [$store->nickname, $album->id]) }}">
                        <img class="p-3" src="{{ Storage::url('file.png') }}" alt="">
                    </a>

                    <div class="title text-center pb-3">
                        {{ $album->name }}
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


</div>
