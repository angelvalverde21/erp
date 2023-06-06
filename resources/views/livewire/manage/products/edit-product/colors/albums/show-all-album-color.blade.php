<div>
    {{-- Success is as dangerous as failure. --}}

    <x-breadcrumbs title="Albums" />

    <x-content>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('manage.products.color.albums.create', [$store->nickname, $color->product_id, $color->id]) }}" class="btn btn-success">Crear Album para el color</a>
            </div>
        </div>
    </x-content>

    <x-content>

        <ul class="list-group">

            @if ($albums->count() > 0)
    
                @foreach ($albums as $album)
                    <li class="list-group-item">{{ $album->name }}</li>
                @endforeach
            @else
                <li class="list-group-item">Aun no se subido albumnes para mostrar</li>
            @endif

        </ul>

    </x-content>

</div>
