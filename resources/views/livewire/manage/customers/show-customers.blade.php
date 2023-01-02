<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="Mis clientes" />

    <x-sectioncontent>
        <div class="card">
            {{-- <div class="card-header">
                <a href="{{ route('manage.customers.create', [$store->nickname]) }}" class="btn btn-primary">Agregar
                    Cliente</a>
            </div> --}}

            <div class="card-header">
                @livewire('manage.customers.create-customer-modal', ['store' => $store], key('create-customer-modal'))
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
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="text-center">{{ $customer->id }}</td>

                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->dni }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td></td>
                                <td>{{ $customer->created_at }}</td>
                                <td></td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.customers.edit', [$store->nickname, $customer->id]) }}"
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


    @push('script-footer')

        <!-- DataTables  & Plugins -->
        <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            $(function() {
                $("#example1").DataTable({
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endpush
</div>
