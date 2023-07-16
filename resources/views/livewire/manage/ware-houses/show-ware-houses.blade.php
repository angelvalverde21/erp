<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-breadcrumbs title="Almacenes" />

    <x-sectioncontent>

        @livewire('manage.ware-houses.create-ware-house')

        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th class="text-center">Nombre</th>
                    <th>Direccion</th>
                    <th>Publicado</th>
                    <th>Acciones</th>
                </tr>
            </thead>


            <tbody>

                @if (isset($wharehouses))
                    @foreach ($wharehouses as $wharehouse)
                        <tr>
                            <td>{{ $wharehouse->id }}</td>
                            <td>{{ $wharehouse->name }}</td>
                            <td>{{ $wharehouse->address->name }}</td>
                            <td>{{ $wharehouse->created_at }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No hay almacenes que mostrar</td>
                    </tr>
                @endif

            </tbody>

        </table>

    </x-sectioncontent>
</div>
