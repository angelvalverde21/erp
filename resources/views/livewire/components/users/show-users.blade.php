<div>

    <x-sectioncontent>
        <div class="card">
            {{-- <div class="card-header">
                <a href="{{ route('manage.users.create', [$store->nickname]) }}" class="btn btn-primary">Agregar
                    Cliente</a>
            </div> --}}

            <div class="card-header">
                @livewire('components.users.create-user-modal', ['store' => $store, 'rol'=> $rol], key('create-customer-modal'))
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">


                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Telefono</th>
                            <th>#Compras</th>
                            <th>cliente desde</th>
                            <th>Tipo Cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->dni }}</td>
                                <td>{{ $user->phone }}</td>
                                <td></td>
                                <td>{{ $user->created_at }}</td>
                                <td></td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.users.edit', [$store->nickname, $user->id]) }}"
                                            class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-secondary"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>


            </div>
            <!-- /.card-body -->
        </div>

    </x-sectioncontent>

</div>
