<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-breadcrumbs title="Mis cuentas" />

    <x-sectioncontent>

        @if ($stores->count() > 0)

            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Nick</th>
                                <th>Ordenes</th>
                                <th>Progress de entrega</th>
                                <th style="width: 40px">Label</th>
                                <th style="width: 80px">ir</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($stores as $store)
                                <tr>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->nickname }}</td>
                                    {{-- <td>{{ $store->orders->count() }}</td> --}}
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>

                                    <td></td>

                                    <td><a href="{{ route('manage.orders', [$store->nickname]) }}"
                                            class="btn btn-success">Ir</a>
                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        @else
            No hay tiendas
        @endif

    </x-sectioncontent>

</div>
