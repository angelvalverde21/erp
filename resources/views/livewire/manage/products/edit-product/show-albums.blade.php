<div>

    <x-sectioncontent>

        @livewire('manage.products.edit-product.create-album', ['product'=> $product], key('product-create-album'))

        <table id="example" class="table table-striped mt-3">

            <thead>
                <tr>
                    <th>Id</th>
                    <th>Imagen</th>
                    <th>Nombre del album</th>
                    {{-- <th>Precio</th> --}}
                    {{-- <th>Stock</th> --}}
                    <th>Publicado</th>
                    <th>Qty</th>
                    <th>Modelo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($product->albums as $album)
                    <tr>
                        <td>{{ $album->id }}</td>
                        {{-- <td class="text-center">

                            @if ($album->images->count() or $album->colors->count())

                                <a href="{{ route('manage.albums.edit', [$store->nickname, $album->id]) }}">
                                    <img width="75" src="{{ $album->image() }}" alt="">
                                </a>

                            @else

                                <a style="color: rgb(100, 100, 100);"
                                    href="{{ route('user.albums.edit', [$store->nickname, $album->id]) }}"><span
                                        style="font-size: 50px;"><i
                                            class="fa-solid fa-image"></i></span></a>

                            @endif
                        </td> --}}
                        {{-- <td><a href="{{ route('manage.albums.edit', [$store->nickname, $album->id]) }}">{{ $album->name }}</a></td> --}}
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->description }}</td>
                        <td>{{ $album->created_at }}</td>
                        <td>{{ $album->images->count() }}</td>
                        <td>{{ $album->modelo->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('manage.albums.edit', [$store->nickname, $album->id]) }}"
                                    class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                {{-- <a href="#" wire:click.prevent="deletealbum({{ $album->id }})" class="btn btn-secondary"><i
                                        class="fa-solid fa-trash"></i></a> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </x-sectioncontent>

</div>
